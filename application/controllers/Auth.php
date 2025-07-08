<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    
    public function register() {
        $this->load->view('register');
    }

    public function register_user() {

        $this->load->library('form_validation');

        $this->form_validation->set_rules(
            'name',
            'Name',
            'required|regex_match[/^[a-zA-Z ]+$/]',
            [
                'required' => 'The Name field is required.',
                'regex_match' => 'The Name field must contain only letters and spaces.'
            ]
        );
        $this->form_validation->set_rules(
            'type',
            'Type',
            'required',
            [
                'required' => 'Need To Select A User-Type'
            ]
        );
        $this->form_validation->set_rules(
            'email',
            'EMail',
            'required|valid_email|is_unique[users.email]',
            [
                'required' => 'The Email field is required.',
                'valid_email' => 'Email format is not correct',
                'is_unique' => 'This email is already registered'
            ]
        );
        $this->form_validation->set_rules(
            'password', 
            'Password', 
            'required|min_length[4]|regex_match[/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/]',
            [
                'required' => 'The Passowrd field is required.',
                'min_length' => 'Passowrd should be of min length 4',
                'regex_match' => 'Password should have atleast 1 uppercase, lowercase, digit and special character'
            ]
        ); 

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('register');
        } else {

            $this->load->model('User_model');
            $name = $this->input->post('name');
            $type = $this->input->post('type');
            $email = $this->input->post('email');
            $password = password_hash($this->input->post('password'),PASSWORD_BCRYPT);
        
            $this->User_model->insert_user($name, $email, $password,$type);
            $data['message'] = "Registered Successfully!";
            $this->load->view('success_page', $data);
        }

    }

    public function login() {
        $this->load->view('login');
    }

    public function login_user(){
        $this->load->library('form_validation');

        $this->form_validation->set_rules(
            'email',
            'EMail',
            'required|valid_email',
            [
                'required' => 'The Email field is required.',
                'valid_email' => 'Email format is not correct',

            ]
        );
        $this->form_validation->set_rules(
            'pwd', 
            'Password', 
            'required',
            [
                'required' => 'The Password field is required.'
            ]
        );
        $this->form_validation->set_rules(
            'type',
            'Type',
            'required',
            [
                'required' => 'Need To Select A User-Type'
            ]
        ); 

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('login');
        } else {
            $this->load->model('User_model');
            $email = $this->input->post('email');
            $pwd = $this->input->post('pwd');
            $type = $this->input->post('type');

            $result = $this->User_model->login_user($email, $pwd, $type);

            if($result['status'] === true){
                $this->load->library('session');

                $session_data = array(
                    'user_id' => $result['user']->id,
                    'user_name' => $result['user']->name,
                    'user_email' => $result['user']->email,
                    'user_password' => $result['user']->password,
                    'type' => $result['user']->type,
                    'logged_in' => TRUE
                );
                $this->session->set_userdata($session_data);
                if(($result['user']->type)==='s'){
                    $st_exist = $this->User_model->student_exist($result['user']->id);
                    if($st_exist){
                        $this->load->view('student_home');    
                    }else{
                        $this->load->view('student_class_details');
                    }
                }else{
                    $this->load->view('teacher_home');
                }
            } else {
                $data['message'] = $result['message'];
                $this->load->view('login', $data);
            }
        }
    }

    public function viewAll(){
        $this->load->model('User_model');
        $data['all_data'] = $this->User_model->viewAll();
        $this->load->view('home',$data);
    }

    public function userUpdate(){
        $id = $this->input->post('id');
        $data['user_id'] = $id;

        $this->load->model('User_model');
        $data['user_name'] = $this->User_model->getName($id);
        $data['user_email'] = $this->User_model->getEmail($id);
        $data['user_pwd'] = $this->User_model->getPwd($id);
        $data['contact'] = $this->User_model->getContact($id);
        $data['gName'] = $this->User_model->getGName($id);
        $data['gCon'] = $this->User_model->getGContact($id);
        $data['add'] = $this->User_model->getAddress($id);
        $this->load->view('user_update', $data);
    }
    public function userUpdate2(){
        $id = $this->input->post('id');
        $data['user_id'] = $id;

        $this->load->model('User_model');
        $data['user_name'] = $this->User_model->getName($id);
        $data['user_pwd'] = $this->User_model->getPwd($id);
        $this->load->view('user_update', $data);
    }

    public function userDelete(){
        $this->session->sess_destroy();
        $this->load->model('User_model');
        $email = $this->input->post('email');
        $this->User_model->delete_user($email);
         redirect('Auth/login');
    }

    public function updateDetails(){

        $this->load->library('form_validation');

        $this->form_validation->set_rules(
            'name',
            'Name',
            'required|regex_match[/^[a-zA-Z ]+$/]',
            [
                'required' => 'The Name field is required.',
                'regex_match' => 'The Name field must contain only letters and spaces.'
            ]
        );
        $this->form_validation->set_rules(
            'pwd', 
            'Password', 
            'min_length[4]|regex_match[/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/]',
            [
                'min_length' => 'Passowrd should be of min length 4',
                'regex_match' => 'Password should have atleast 1 uppercase, lowercase, digit and special character'
            ]
        ); 

        if ($this->form_validation->run() == FALSE) {
            //$this->load->view('user_update');
            $this->userUpdate2();
        } else {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $pwd = $this->input->post('pwd');
        $con = $this->input->post('contact');
        $gName = $this->input->post('gName');
        $gCon =$this->input->post('gCon');
        $add = $this->input->post('address');
        $this->load->model('User_model');

        if (!empty($pwd)) {
            $hashed_pwd = password_hash($pwd, PASSWORD_BCRYPT);
        } else {
            $hashed_pwd = $this->User_model->getPwd($id);
        }
        $this->User_model->updateStudentDetails($id,$con,$gName, $gCon,$add);
        $this->User_model->updateDetails($id,$name,$hashed_pwd);
        $this->load->view('login');
        }
    }

    public function activate_user(){
        $id = $this->input->post('id');
        $this->load->model('User_model');
        $this->User_model->activateUser($id);
        redirect('home/index');
    }

    public function deactivate_user(){
        $id = $this->input->post('id');
        $this->load->model('User_model');
        $this->User_model->deactivateUser($id);
        redirect('home/index');
    }

    public function logout(){
        $this->session->sess_destroy();
        redirect('login');
    }

    public function userProfile(){
        if($this->session->userdata('type')==='s'){
            $this->load->view('student_home');
        }
        else if($this->session->userdata('type')==='t'){
            $this->load->view('teacher_home');
        }
    }
    public function get_subjects() {
        $class = $this->input->post('class');
        $section = $this->input->post('section');

        $this->db->where('class', $class);
        if ($class == 11) {
            $this->db->where('section', $section);
        }
        $query = $this->db->get('class_details');
        $row = $query->row();

        $subjects = [];
        if ($row) {
            for ($i = 1; $i <= 5; $i++) {
                $field = "subj$i";
                if (!empty($row->$field)) {
                    $subjects[] = $row->$field;
                }
            }
        }

        echo json_encode($subjects);
    }

    public function studentClassDetails(){
        $subjects = $this->input->post('subjects');
        $roll_no = $this->input->post('roll_no');
        $class = $this->input->post('class');
        $sec = $this->input->post('section');
        
        $this->load->model('User_model');

        $this->User_model->insertStudent($roll_no, $class, $sec);

        $this->User_model->enterClassDetails($roll_no, $subjects);
        $this->load->view('student_home');
    }

    public function studentProfile(){
        $this->load->model('User_model');
        $st_data = $this->User_model->studentProfile($this->session->userdata('user_id'));
        $this->load->view('student_profile',$st_data);
    }

    public function viewMarks(){
        $this->load->model('User_model');
        $marks = $this->User_model->getStudentMarks($this->session->userdata('user_id'));
        $data['percent'] = $this->User_model->getPercent($this->session->userdata('user_id'));
        $data['st_data'] = $marks;
        $data['class'] = $this->User_model->getClass($this->session->userdata('user_id'));
        $data['section'] = $this->User_model->getSection($this->session->userdata('user_id'));

        $this->load->view('student_marks', $data);
    }

    public function teacherProfile(){
        $this->load->view('teacher_profile');
    }
    public function teacherUpdate(){
        $id = $this->input->post('id');
        $data['user_id'] = $id;

        $this->load->model('User_model');
        $data['user_name'] = $this->User_model->getName($id);
        $data['user_email'] = $this->User_model->getEmail($id);
        $data['user_pwd'] = $this->User_model->getPwd($id);

        $this->load->view('teacher_update', $data);
    }
    public function teacherUpdateDetails(){

        $this->load->library('form_validation');

        $this->form_validation->set_rules(
            'name',
            'Name',
            'required|regex_match[/^[a-zA-Z ]+$/]',
            [
                'required' => 'The Name field is required.',
                'regex_match' => 'The Name field must contain only letters and spaces.'
            ]
        );
        $this->form_validation->set_rules(
            'pwd', 
            'Password', 
            'min_length[4]|regex_match[/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/]',
            [
                'min_length' => 'Passowrd should be of min length 4',
                'regex_match' => 'Password should have atleast 1 uppercase, lowercase, digit and special character'
            ]
        ); 

        if ($this->form_validation->run() == FALSE) {
            //$this->load->view('user_update');
            $this->userUpdate2();
        } else {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $pwd = $this->input->post('pwd');

        $this->load->model('User_model');

        if (!empty($pwd)) {
            $hashed_pwd = password_hash($pwd, PASSWORD_BCRYPT);
        } else {
            $hashed_pwd = $this->User_model->getPwd($id);
        }
        $this->User_model->updateDetails($id,$name,$hashed_pwd);
        $this->session->sess_destroy();
        redirect('login');
        }
    }

    public function uploadMarks(){
        $this->load->view('teacher_upload_marks');
    }

    public function teacherSearch(){
        $class = $this->input->post('class');
        $sec = $this->input->post('section');
        //$subj = $this->input->post('subject');
        $rollNo = $this->input->post('rollNo');

        $this->load->model('User_model');

        //$t_data = $this->User_model->teacherSearch($class,$sec,$subj);
        $t_data = $this->User_model->teacherSearch($class,$sec,$rollNo);
        $this->load->view('teacher_upload_marks', ['t_data' => $t_data]);

    }

    public function updateMarks() {
    $this->load->model('User_model');
    $marksArray = $this->input->post('marksArr');
    $rollNo = $this->input->post('rollNo');
    $by = $this->session->userdata('user_id');

    foreach ($marksArray as $subject => $marks) {

        $this->form_validation->set_rules(
            'marksArr[' . $subject . ']', 
            'Marks for ' . $subject,      
            'required|callback_marks_check'
        );
    }

    if ($this->form_validation->run() == FALSE) {
        $this->teacherSearch(); 
    } else {
        foreach ($marksArray as $subject => $marks) {
            $this->User_model->updateMarks($rollNo, $subject, $marks, $by);
        }
        $this->load->view('teacher_home');
    }
}

    public function marks_check($input) {
        if (strtolower(trim($input)) === 'not uploaded') {
            return TRUE;
        }

        if (is_numeric($input) && $input >= 0 && $input <= 100) {
            return TRUE;
        }

        $this->form_validation->set_message('marks_check', 'Mark must be between 0 and 100');
        return FALSE;
    }

    public function getRollNos() {
        $class = $this->input->post('class');
        $section = $this->input->post('section');

        $this->load->model('User_model');
        $rollNos = $this->User_model->getRollNos($class, $section);

        if(!empty($rollNos)){
            echo '<option value="">Select Roll No.</option>';
            foreach ($rollNos as $rn) {
            echo "<option value='{$rn}'>{$rn}</option>";
            }
        }else{
            echo '<option value="">No Students in this Class</option>';
        }
        
    }
    public function uploadSM(){
        $this->load->view('teacher_upload_sm');
    }

    public function getSubjects() {
        $class = $this->input->post('class');
        $section = $this->input->post('section');

        $this->load->model('User_model');
        if($class==="10"){
            $rollNos = $this->User_model->get5Subjects($class);
        }else{
            $rollNos = $this->User_model->getSubjects($class, $section);
        }

        if(!empty($rollNos)){
            echo '<option value="">Select Subject</option>';
            foreach ($rollNos as $rn) {
            echo "<option value='{$rn}'>{$rn}</option>";
            }
        }else{
            echo '<option value="">No Subjects in this Class</option>';
        }
        
    }

    public function teacherUploadSearch(){
        $class = $this->input->post('class');
        $sec = $this->input->post('section');
        $subj = $this->input->post('subject');

        $this->load->model('User_model');

        $data['t_data'] = $this->User_model->teacherUploadSearch($class,$sec,$subj);
        $data['subjCode'] = $this->User_model->getSubjectCode($subj);
        $data['class'] = $class;
        $data['section'] = $sec;
        $data['subject'] = $subj;
        $this->load->view('teacher_upload_sm', $data);

    }
    public function upload() {
        $result = 'error';
        $targetDir = "uploads/";

        if(isset($_POST["submit"])){
            if(!empty($_FILES["file"]["name"])){
                $fileName = basename($_FILES["file"]["name"]);
                $targetFilePath = $targetDir . $fileName;
                $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

                $allowTypes = array('jpg', 'png', 'jpeg', 'pdf');
                if(in_array($fileType, $allowTypes)){
                    if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
                        $this->load->model('User_model');
                        $insert = $this->User_model->saveStudyMaterial([
                            'class' => $this->input->post('class'),
                            'section' => $this->input->post('section'),
                            'subject_code' => $this->input->post('subject_code'),
                            'title' => $this->input->post('title'),
                            'description' => $this->input->post('desc'),
                            'upload_link' => $fileName,
                            'uploaded_by' => $this->input->post('by')
                        ]);
                        if($insert > 0){
                            $result = 'successfully uploaded';
                    } else {
                        $result= "File upload failed, please try again.";
                    }
                } else {
                   $result= "Sorry, there was an error uploading your file.";
                }
            } else {
                $result = 'Only JPG, JPEG, PNG, & PDF files are allowed.';
            }
        } else {
            $result= 'Please select a file to upload.';
        }
    }
        $class = $this->input->post('class');
        $sec = $this->input->post('section');
        $subj = $this->input->post('subject');

        $this->load->model('User_model');

        $data['t_data'] = $this->User_model->teacherUploadSearch($class,$sec,$subj);
        $data['subjCode'] = $this->User_model->getSubjectCode($subj);
        $data['class'] = $class;
        $data['section'] = $sec;
        $data['subject'] = $subj;
        $data['status'] = $result;
        $this->load->view('teacher_upload_sm', $data);
}

    public function viewSM(){
        $this->load->model('User_model');

        $data['sm_data'] = $this->User_model->viewSM();
        $this->load->view('student_sm',$data);
    }

    public function delete_sm(){
        $id = $this->input->post('id');
        $this->load->model('User_model');
        $this->User_model->deleteSM($id);
        $this->teacherUploadSearch();
    }

}
