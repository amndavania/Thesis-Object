<?php

namespace App\Repositories;

use App\Models\Student;
use App\Models\Ukt;
use Illuminate\Support\Facades\DB;

class StudentRepository implements StudentRepositoryInterface
{
    protected $model;

    public function __construct(Student $model)
    {
        $this->model = $model;
    }

    public function getAll($filters = [])
    {
        $query = DB::table('students')
            ->leftJoin('ukts', 'students.id', '=', 'ukts.students_id')
            ->leftJoin('student_types', 'students.student_types_id', '=', 'student_types.id')
            ->leftJoin('study_programs', 'students.study_program_id', '=', 'study_programs.id')
            ->leftJoin('dpas', 'students.dpa_id', '=', 'dpas.id')
            ->select(
                'students.id',
                'students.name',
                'students.nim',
                'students.force',
                'dpas.name AS dpas_name',
                'student_types.type AS student_type',
                'study_programs.name AS study_program_name',
                DB::raw('MAX(ukts.status) AS status')
            )
            ->groupBy(
                'students.id',
                'students.name',
                'students.nim',
                'students.force',
                'dpas_name',
                'student_type',
                'study_program_name'
            );
    
        // ikuti pola controller lama (pakai elseif)
        if (!empty($filters['students_id'])) {
            $query->where('students.id', $filters['students_id']);
        } elseif (!empty($filters['prodi_search_id']) && !empty($filters['angkatan_search_id'])) {
            $query->where('students.study_program_id', $filters['prodi_search_id'])
                  ->where('students.force', $filters['angkatan_search_id']);
        } elseif (!empty($filters['prodi_search_id'])) {
            $query->where('students.study_program_id', $filters['prodi_search_id']);
        } elseif (!empty($filters['angkatan_search_id'])) {
            $query->where('students.force', $filters['angkatan_search_id']);
        }
    
        return $query->paginate(20);
    }
    

    public function findById($id)
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $student = $this->findById($id);
        $student->update($data);
        return $student;
    }

    public function delete($id)
    {
        $student = $this->findById($id);
        return $student->delete();
    }

    public function hasUkt($id): bool
    {
        return Ukt::where('students_id', $id)->exists();
    }
}
