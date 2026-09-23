<?php

namespace Tests\Feature;

use App\Models\Consultation;
use App\Models\Patient;
use App\Models\Prescription;
use App\Models\Triage;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClinicWorkflowTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_from_dashboard_to_login(): void
    {
        $this->get('/dashboard')->assertRedirect('/login');
    }

    public function test_staff_can_register_patient_and_create_first_visit(): void
    {
        $staff = User::factory()->staff()->create();

        $this->actingAs($staff)
            ->post(route('patients.store'), [
                'full_name' => 'Jane Wanjiku',
                'phone' => '0712345678',
                'gender' => 'Female',
                'date_of_birth' => '1990-05-05',
            ])
            ->assertRedirect();

        $this->assertDatabaseHas('patients', [
            'full_name' => 'Jane Wanjiku',
            'serial_number' => 'PAT-'.now()->year.'-0001',
        ]);

        $this->assertDatabaseHas('visits', [
            'patient_id' => Patient::first()->id,
            'visit_no' => 1,
            'created_by' => $staff->id,
        ]);
    }

    public function test_staff_triage_puts_patient_on_waiting_list(): void
    {
        $staff = User::factory()->staff()->create();
        $patient = Patient::factory()->create();
        $visit = $patient->visits()->create([
            'visit_no' => 1,
            'visit_date' => now(),
            'created_by' => $staff->id,
        ]);

        $this->actingAs($staff)
            ->put(route('triage.update', $visit), [
                'chief_complaint' => 'Fever and headache',
                'bp' => '120/80',
                'temp' => 38.5,
                'pulse' => 90,
                'resp' => 20,
                'weight' => 60,
                'height' => 160,
                'lab_tests' => 'Malaria test',
            ])
            ->assertRedirect();

        $this->assertDatabaseHas('triages', [
            'visit_id' => $visit->id,
            'chief_complaint' => 'Fever and headache',
        ]);

        $this->assertDatabaseHas('visits', ['id' => $visit->id, 'triage_done' => true]);
    }

    public function test_bmi_is_calculated_automatically(): void
    {
        $staff = User::factory()->staff()->create();
        $patient = Patient::factory()->create();
        $visit = $patient->visits()->create([
            'visit_no' => 1,
            'visit_date' => now(),
            'created_by' => $staff->id,
        ]);

        $this->actingAs($staff)
            ->put(route('triage.update', $visit), [
                'weight' => 60,
                'height' => 160,
            ])
            ->assertRedirect();

        $this->assertDatabaseHas('triages', [
            'visit_id' => $visit->id,
            'bmi' => 23.44, // 60 / (1.6 * 1.6)
        ]);
    }

    public function test_doctor_sees_triaged_patients_in_waiting_list(): void
    {
        $doctor = User::factory()->doctor()->create();
        $staff = User::factory()->staff()->create();
        $patient = Patient::factory()->create();

        $waiting = $patient->visits()->create([
            'visit_no' => 1,
            'visit_date' => now(),
            'triage_done' => true,
            'created_by' => $staff->id,
        ]);

        $notTriaged = $patient->visits()->create([
            'visit_no' => 2,
            'visit_date' => now(),
            'triage_done' => false,
            'created_by' => $staff->id,
        ]);

        $this->actingAs($doctor)
            ->get(route('dashboard'))
            ->assertOk()
            ->assertSee($patient->full_name)
            ->assertSee(route('consultations.show', $waiting))
            ->assertDontSee(route('consultations.show', $notTriaged));
    }

    public function test_doctor_can_save_consultation_and_prescription(): void
    {
        $doctor = User::factory()->doctor()->create();
        $staff = User::factory()->staff()->create();
        $patient = Patient::factory()->create();
        $visit = $patient->visits()->create([
            'visit_no' => 1,
            'visit_date' => now(),
            'triage_done' => true,
            'created_by' => $staff->id,
        ]);

        $this->actingAs($doctor)
            ->put(route('consultations.update', $visit), [
                'history' => 'Two-day history of fever.',
                'examination' => 'Temp 38.5, mild dehydration.',
                'diagnosis' => 'Malaria',
                'treatment' => 'Fluids and rest',
                'referral' => 0,
                'drugs' => [
                    [
                        'drug_name' => 'Panadol 500mg',
                        'dosage' => '500mg',
                        'frequency' => 'Twice a day',
                        'duration' => '5 days',
                        'quantity' => '10',
                    ],
                ],
            ])
            ->assertRedirect();

        $this->assertDatabaseHas('consultations', [
            'visit_id' => $visit->id,
            'doctor_id' => $doctor->id,
            'diagnosis' => 'Malaria',
        ]);

        $this->assertDatabaseHas('prescriptions', [
            'visit_id' => $visit->id,
            'drug_name' => 'Panadol 500mg',
        ]);
    }

    public function test_doctor_completing_visit_marks_consultation_done(): void
    {
        $doctor = User::factory()->doctor()->create();
        $staff = User::factory()->staff()->create();
        $patient = Patient::factory()->create();
        $visit = $patient->visits()->create([
            'visit_no' => 1,
            'visit_date' => now(),
            'triage_done' => true,
            'created_by' => $staff->id,
        ]);

        $this->actingAs($doctor)
            ->put(route('consultations.update', $visit), [
                'history' => 'Cough for one week.',
                'examination' => 'Clear chest.',
                'diagnosis' => 'URTI',
                'complete' => 1,
                'drugs' => [],
            ])
            ->assertRedirect();

        $this->assertDatabaseHas('visits', [
            'id' => $visit->id,
            'consultation_done' => true,
            'completed' => true,
        ]);
    }

    public function test_empty_consultation_is_not_saved(): void
    {
        $doctor = User::factory()->doctor()->create();
        $staff = User::factory()->staff()->create();
        $patient = Patient::factory()->create();
        $visit = $patient->visits()->create([
            'visit_no' => 1,
            'visit_date' => now(),
            'triage_done' => true,
            'created_by' => $staff->id,
        ]);

        $this->actingAs($doctor)
            ->put(route('consultations.update', $visit), [
                'history' => '',
                'examination' => '',
            ])
            ->assertRedirect();

        $this->assertDatabaseMissing('consultations', ['visit_id' => $visit->id]);
        $this->assertDatabaseHas('visits', ['id' => $visit->id, 'consultation_done' => false]);
    }

    public function test_staff_can_dispense_prescription(): void
    {
        $staff = User::factory()->staff()->create();
        $patient = Patient::factory()->create();
        $visit = $patient->visits()->create(['visit_no' => 1, 'visit_date' => now()]);
        $prescription = Prescription::create([
            'visit_id' => $visit->id,
            'drug_name' => 'Amoxicillin',
            'status' => 'Pending',
        ]);

        $this->actingAs($staff)
            ->post(route('prescriptions.dispense', $prescription))
            ->assertRedirect();

        $this->assertDatabaseHas('prescriptions', [
            'id' => $prescription->id,
            'status' => 'Dispensed',
            'dispensed_by' => $staff->id,
        ]);
    }

    public function test_staff_cannot_open_doctor_consultation_form(): void
    {
        $staff = User::factory()->staff()->create();
        $patient = Patient::factory()->create();
        $visit = $patient->visits()->create(['visit_no' => 1, 'visit_date' => now()]);

        $this->actingAs($staff)
            ->get(route('consultations.show', $visit))
            ->assertRedirect(route('dashboard'));
    }

    public function test_doctor_cannot_access_register_patient(): void
    {
        $doctor = User::factory()->doctor()->create();

        $this->actingAs($doctor)
            ->get(route('patients.create'))
            ->assertRedirect(route('dashboard'));
    }

    public function test_staff_view_patient_shows_consultation_and_prescription(): void
    {
        $staff = User::factory()->staff()->create();
        $patient = Patient::factory()->create();
        $visit = $patient->visits()->create(['visit_no' => 1, 'visit_date' => now()]);

        Triage::create(['visit_id' => $visit->id, 'chief_complaint' => 'Headache']);
        Consultation::create([
            'visit_id' => $visit->id,
            'history' => 'Headache for three days.',
            'diagnosis' => 'Migraine',
        ]);
        Prescription::create(['visit_id' => $visit->id, 'drug_name' => 'Brufen']);

        $this->actingAs($staff)
            ->get(route('patients.show', $patient))
            ->assertOk()
            ->assertSee('Migraine')
            ->assertSee('Brufen');
    }

    public function test_login_accepts_username(): void
    {
        $user = User::factory()->create([
            'username' => 'janestaff',
            'password' => 'secret123',
            'role' => 'staff',
        ]);

        $this->post(route('login'), [
            'username' => 'janestaff',
            'password' => 'secret123',
        ])->assertRedirect(route('dashboard'));

        $this->assertAuthenticatedAs($user);
    }
}
