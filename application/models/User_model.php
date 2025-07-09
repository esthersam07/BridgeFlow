<?php
class User_model extends CI_Model {

    public function insert_user($name, $email, $password,$type){
        $data = array(
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'type' => $type
        );
        $this->db->insert('users', $data);
    }

    public function user_exist($email){
        $query = $this->db->get_where('users', array('email' => $email));
        return $query->row();
    }
    public function login_user($email, $password, $type){
        $user = $this->user_exist($email);
        if($user){
            if(($user->status)==='n'){
                return array('status'=>false, 'message'=>"Deactive Account");
            }
            else if((password_verify($password,$user->password)) && ($type===$user->type)){
                return array('status'=>true, 'user'=>$user);
            } 
            else if(!($type===$user->type)){
                return array('status'=>false, 'message'=>"Incorrect User-type");
            }
            else {
                return array('status'=>false, 'message'=>"Incorrect password");
            }
        } else {
            return array('status'=>false, 'message'=>"Email ID not registered");
        }
    }

    public function delete_user($email){
        $this->db->set('status','n');
        $this->db->where('email',$email);
        $this->db->update('users');
    }

    public function updateDetails($id,$name,$pwd){
        $data = [
        'name' => $name,
        'password' => $pwd
        ];
        $this->db->where('id', $id);
        $this->db->update('users', $data);
    }
    /*public function updateName($id,$name){
        $this->db->set('name', $name);
        $this->db->where('id', $id);
        $this->db->update('users');
    }
    public function updateEmail($id,$email){
        $this->db->set('email', $email);
        $this->db->where('id', $id);
        $this->db->update('users');
    }
    public function updatePwd($id,$pwd){
        $this->db->set('password', $pwd);
        $this->db->where('id', $id);
        $this->db->update('users');
    }*/

    public function viewAll(){
        $query = $this->db->get('users');
        return $query->result_array();
    }

    public function getName($id){
        $query = $this->db->select('name')->where('id', $id)->get('users');
        $name = $query->row()->name;
        return $name;
    }
    public function getEmail($id){
        $query = $this->db->select('email')->where('id', $id)->get('users');
        $email = $query->row()->email;
        return $email;
    }
    public function getPwd($id){
        $query = $this->db->select('password')->where('id', $id)->get('users');
        $pwd = $query->row()->password;
        return $pwd;
    }
    public function getContact($id){
        $query = $this->db->select('contact')->where('roll_no', $id)->get('student_details');
        $op = $query->row()->contact;
        return $op;
    }
    public function getGName($id){
        $query = $this->db->select('guardian_name')->where('roll_no', $id)->get('student_details');
        $op = $query->row()->guardian_name;
        return $op;
    }
    public function getGContact($id){
        $query = $this->db->select('guardian_contact')->where('roll_no', $id)->get('student_details');
        $op = $query->row()->guardian_contact;
        return $op;
    }
    public function getAddress($id){
        $query = $this->db->select('address')->where('roll_no', $id)->get('student_details');
        $op = $query->row()->address;
        return $op;
    }
    public function activateUser($id){
        $this->db->set('status', 'y');
        $this->db->where('id', $id);
        $this->db->update('users');
    }
    public function deactivateUser($id){
        $this->db->set('status', 'n');
        $this->db->where('id', $id);
        $this->db->update('users');
    }
    public function student_exist($id){
        $this->db->where('roll_no', $id);
        $query = $this->db->get('student_details');

        return $query->num_rows() > 0;
    }

    public function insertStudent($rollNo, $class, $sec){
        $data = array(
            'roll_no' => $rollNo,
            'class' => $class,
            'section' => $sec,
        );
        $this->db->insert('student_details', $data);
    }
    public function enterClassDetails($roll_no, $subjects){
        foreach ($subjects as $subject) {
            $this->db->insert('marks', [
            'roll_no' => $roll_no,
            'subject' => $this->getSubjectCode($subject),
        ]);
        }
    }
     public function getSubjectCode($subj_name){
        $query = $this->db->select('code')->where('name', $subj_name)->get('subjects');
        if ($query->num_rows() > 0) {
            return $query->row()->code;
        }
        return null; 
    }
    public function getSubjectName($code){
        $query = $this->db->select('name')->where('code', $code)->get('subjects');
        $op = $query->row()->name;
        return $op;
    }
    public function studentProfile($id){
    $this->db->select('*');
    $this->db->from('student_details');
    $this->db->where('roll_no', $id);
    $details = $this->db->get()->row_array();

    return [
        'details' => $details
    ];
    }

    public function updateStudentDetails($id,$con,$gName, $gCon,$add){
        $data = [
        'contact' => $con,
        'guardian_name' => $gName,
        'address' => $add,
        'guardian_contact' => $gCon,
        ];
        $this->db->where('roll_no', $id);
        $this->db->update('student_details', $data);
    }

    public function getStudentMarks($id) { 
         $sql = "SELECT m.roll_no, m.subject, subj.name as subjName, m.marks 
            FROM marks m
            join subjects subj on subj.code = m.subject
            WHERE  m.roll_no = ?";
    
        $query = $this->db->query($sql, array( $id));
        return $query->result_array();
    }

    /*public function teacherSearch($class, $sec, $subj) {
         $sql = "SELECT m.roll_no, m.subject, m.marks 
            FROM marks m
            JOIN student_details sd ON m.roll_no = sd.roll_no
            WHERE sd.class = ? AND sd.section = ? AND m.subject = ?";
    
        $query = $this->db->query($sql, array($class, $sec, $subj));
        return $query->result_array();
    }*/

    public function teacherSearch($class, $sec, $rollNo) {
         $sql = "SELECT m.roll_no, m.subject, subj.name as subjName, m.marks , u.id, u.name, u.email, sd.class,sd.section
            FROM marks m
            JOIN student_details sd ON m.roll_no = sd.roll_no
            JOIN users u on sd.roll_no = u.id
            join subjects subj on subj.code = m.subject
            WHERE sd.class = ? AND sd.section = ? AND m.roll_no = ?";
    
        $query = $this->db->query($sql, array($class, $sec, $rollNo));
        return $query->result_array();
    }

    public function updateMarks($rollNo, $subj, $marks,$by){
        $data = [
        'marks' => $marks,
        'uploaded_by' => $by
        ];
        $this->db->where('roll_no', $rollNo);
        $this->db->where('subject', $subj);
        $this->db->update('marks', $data);

        log_message('debug', 'Updated: RollNo=' . $rollNo . ', Subject=' . $subj . ', Marks=' . $marks);
    log_message('debug', 'Last Query: ' . $this->db->last_query());
    }

    public function getRollNos($class, $section){
        $this->db->select('roll_no');
        $this->db->from('student_details');
        $this->db->where('class', $class);
        $this->db->where('section', $section);
        $query = $this->db->get();

        return array_column($query->result_array(), 'roll_no');
    }

    public function getPercent($rollNo){
        $this->db->select('SUM(marks) as total_obtained, COUNT(subject) as total_subjects');
        $this->db->from('marks');
        $this->db->where('roll_no', $rollNo);
        $this->db->where("marks REGEXP '^[0-9]+$'"); 
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $row = $query->row();
            $total = $row->total_obtained;
            $count = $row->total_subjects;
        
            if ($count > 0) {
                $percentage = ($total / ($count * 100)) * 100;
                return round($percentage, 2); 
            }
        }
        return null;
    }
    public function getClass($id){
        $query = $this->db->select('class')->where('roll_no', $id)->get('student_details');
        $class = $query->row()->class;
        return $class;
    }
    public function getSection($id){
        $query = $this->db->select('section')->where('roll_no', $id)->get('student_details');
        $sec = $query->row()->section;
        return $sec;
    }

    public function getSubjects($class, $section){
        $this->db->select('subj1, subj2, subj3, subj4,subj5');
        $this->db->from('class_details');
        $this->db->where('class', $class);
        $this->db->where('section', $section);
        $query = $this->db->get();

        $row = $query->row_array();
    $subjects = [];

    foreach ($row as $subject) {
        if (!empty($subject)) {
            $subjects[] = $subject;
        }
    }

    return $subjects;
    }
    public function get5Subjects($class){
        $this->db->select('subj1, subj2, subj3, subj4, subj5');
        $this->db->from('class_details');
        $this->db->where('class', $class);
        $query = $this->db->get();
        $row = $query->row_array();
    $subjects = [];

    foreach ($row as $subject) {
        if (!empty($subject)) {
            $subjects[] = $subject;
        }
    }

    return $subjects;
    }

    public function teacherUploadSearch($class, $sec, $subj) {
         $sql = "SELECT sm.id, sm.class,sm.section, sm.subject_code, subj.name, sm.title, sm.description, sm.upload_link, sm.uploaded_by,sm.upload_date
            FROM study_mat sm
            join subjects subj on subj.code = sm.subject_code
            WHERE sm.class = ? AND sm.section = ? AND subj.name = ? AND sm.status='active' ";
    
        $query = $this->db->query($sql, array($class, $sec, $subj));
        return $query->result_array();
    }
    
    public function saveStudyMaterial($data) {
  
        if (!isset($data['upload_date'])) {
            $data['upload_date'] = date('Y-m-d H:i:s');
        }
        if (!isset($data['status'])) {
            $data['status'] = 'active';
        }

        $this->db->insert('study_mat', $data);
        return 1; // Return the ID of the newly inserted record
    }
    public function getSubjectNameByCode($subj_code){
        $query = $this->db->select('name')->where('code', $subj_code)->get('subjects');
        if ($query->num_rows() > 0) {
            return $query->row()->name;
        }
        return null;
    }

    public function viewSM(){
        $sql = "SELECT * from study_mat";
    
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function deleteSM($id){
        $this->db->set('status', 'inactive');
        $this->db->where('id', $id);
        $this->db->update('study_mat');
    }

    public function studentSMSearch($class, $sec, $subjCode) {
         $sql = "SELECT sm.id, sm.class,sm.section, sm.subject_code, sm.title, sm.description, sm.upload_link, u.name as uploaded_by,sm.upload_date
            FROM study_mat sm
            join users u on u.id=sm.uploaded_by
            WHERE sm.class = ? AND sm.section = ? AND sm.subject_code=? AND sm.status='active' ";
    
        $query = $this->db->query($sql, array($class, $sec, $subjCode));
        return $query->result_array();
    }

}
