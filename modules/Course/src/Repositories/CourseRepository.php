<?php

namespace Modules\Course\src\Repositories;

use App\Repositories\BaseRepository;
use Modules\Course\src\Models\Course;
use Modules\Course\src\Repositories\CourseRepositoryInterface;

class CourseRepository extends BaseRepository implements CourseRepositoryInterface
{
    public function getModel()
    {
        return Course::class;
    }


    public function getAllCourses()
    {
        return $this->model->select(['id', 'name', 'price', 'status', 'created_at']);
    }
}
