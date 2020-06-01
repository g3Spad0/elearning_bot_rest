<?php

class CourseSave
{
    private $pdo;
    private $error;

    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->pdo->beginTransaction();
    }

    private function checkDB($sql, $array) {
        $stmp = $this->pdo->prepare($sql);
        $stmp->execute($array);
        return $stmp->fetchAll(PDO::FETCH_ASSOC);
    }

    public function saveCourse($companyId, $adminId, $name, $flag = false) {
        if (empty($name) || strlen($name) > 100) {
            $this->error = "invalid course name";
            return 0;
        }
        if ($flag === true && !empty($this->checkDB("select course_id from course where company_id=:company_id and name=:name", [ $companyId, $name ]))) {
            $this->error = "course already exists";
            return 0;
        }
        $stmt = $this->pdo->prepare("INSERT INTO course(company_id,	created_admin,name) VALUES (?,?,?)");
        $stmt->execute([ $companyId, $adminId, $name ]);

        return $this->pdo->lastInsertId();
    }

    public function saveRole($companyId, $courseId, $name, $reaction_count, $reaction_interval, $reaction_day_sum, $flag = false) {
        if (empty($name) || strlen($name) > 100) {
            $this->error = "invalid role name";
            print $name;
            return 0;
        }
        if ($reaction_count < 0 || $reaction_interval < 0 || $reaction_day_sum < 0) {
            $this->error = "invalid reaction values";
            return 0;
        }
        if ($flag === true && !empty($this->checkDB("select user_type_id from users_type where course_id=:course_id and name=:name", [ $courseId, $name ]))) {
            $this->error = "user role already exists";
            return 0;
        }
        $stmt = $this->pdo->prepare("INSERT INTO users_type(company_id,	course_id,name, reaction_count, reaction_interval, reaction_day_sum) VALUES (?,?,?,?,?,?)");
        $stmt->execute([ $companyId, $courseId, $name, $reaction_count, $reaction_interval, $reaction_day_sum ]);

        return $this->pdo->lastInsertId();
    }

    public function saveDay($companyId, $course_id, $users_type_id, $number, $flag = false) {
        if ($number <= 0 || $number >= 366) {
            $this->error = "invalid number";
            return 0;
        }
        if ($flag === true && !empty($this->checkDB("select days_id from days where users_type_id=:users_type_id and number=:number", [ $users_type_id, $number ]))) {
            $this->error = "day already exists";
            return 0;
        }
        $stmt = $this->pdo->prepare("INSERT INTO days(company_id, course_id, users_type_id, number) VALUES (?,?,?,?)");
        $stmt->execute([ $companyId, $course_id, $users_type_id, $number ]);

        return $this->pdo->lastInsertId();
    }

    public function hasRepeats($array, $hash) {
        $arr = [];

        for ($i = 0; !empty($array) && $i < count($array); ++$i) {
            if ($arr[$array[$i][$hash]] === true) {
                return true;
            }

            $arr[$array[$i][$hash]] = true;
        }
        return false;
    }

    public function ok() {
        $this->pdo->commit();
    }

    public function getError() {
        $this->pdo->rollBack();
        return $this->error;
    }
}