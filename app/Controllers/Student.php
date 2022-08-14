<?php

namespace App\Controllers;

use App\Models\Studentmodels;

class Student extends BaseController
{
    public function index()
    {
        return view('student/add_student');
    }
    public function store()
    {
      $student = new Studentmodels;
      $data = [
        'name' => $this->request->getPost('name'),
        'email' => $this->request->getPost('email'),
        'phone' => $this->request->getPost('phone'),
        'course' => $this->request->getPost('course'),
      ];
      $student->save($data);
      $data = ['status'=>'Student Added Sucessfully'];
      return $this->response->setJSON($data);
    }
    public function fetch()
    {
      $students = new Studentmodels();
      $data['students'] = $students->findAll();
      return $this->response->setJSON($data);
    }
}
