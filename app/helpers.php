<?php
use Rakibhstu\Banglanumber\NumberToBangla;

if(!function_exists('css')){
    function css($file, $directory = 'css'){
        return asset("$directory/$file");
    }
}



if(!function_exists('js')){
    function js($file, $directory = 'js'){
        return asset("/$directory/$file");
    }
}



function convert_base64_from_path($path){
    $path = public_path().$path;

    if (file_exists($path)) {
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        return $base64;
    }
    return null;
}


function square_img($path = null){
    if($path){
        if(file_exists(public_path().$path)){
            return $path;
        }
    }

    return '/backend/images/square-img.png';
}
function welcome_img($path = null){
    if($path){
        if(file_exists(public_path().$path)){
            return $path;
        }
    }

    return '/img/demo-welcome.png';
}

function get_settings($title){
    return \App\Models\Setting::where('id', 1)->first()->$title ?? null;
}

function shortText($string,$length = 50){
    $string = strip_tags($string);
    if (strlen($string) > $length) {

        // truncate string
        $stringCut = substr($string, 0, $length);
        $endPoint = strrpos($stringCut, ' ');

        //if the string doesn't contain any space then it will cut without word basis.
        $string = $endPoint? substr($stringCut, 0, $endPoint)."..." : substr($stringCut, 0)."...";
    }
    return $string;
}
function getStudentNumber($affiliation_id,$affiliationDetail_id,$class_id){
  $student_number = App\Models\AffiliatedStudent::where('affiliation_id',$affiliation_id)->where('details_id',$affiliationDetail_id)->where('class_id',$class_id)->first();
  if(!empty($student_number)){
    return $student_number;
  }else{
    return false;
  }
}
function getCommitteeName($affiliationDetail_id,$serial_no){
  $committee = App\Models\AffiliatedCommittee::where('details_id',$affiliationDetail_id)->where('serial_no',$serial_no)->first();
  if(!empty($committee)){
    return $committee;
  }else{
    return false;
  }
}
function routine_detail($routine_id,$exam_id,$education_level_id,$subject_id){
  $routine_detail = App\Models\RoutineDetail::where('routine_id',$routine_id)->where('exam_id',$exam_id)->where('education_level_id',$education_level_id)->where('subject_id',$subject_id)->first();
  if(!empty($routine_detail)){
    return $routine_detail;
  }else{
    return false;
  }
}
function getPayment($id){
  $getPayment = App\Models\Payment::where('id',$id)->first();
  if(!empty($getPayment)){
    return $getPayment;
  }else{
    return false;
  }
}
function registrationWise($paper_number,$roll_number){
  $regi = App\Models\Registration::select('id','studnet_id','affiliate_id','subject_id','exam_id','paper_number','roll_number')->where('paper_number',$paper_number)->where('roll_number',$roll_number)->first();
  if(!empty($regi)){
    return $regi;
  }else{
    return false;
  }
}
function registrationWiseStudent($registration_number){
  $student = App\Models\Student::where('registration_number',$registration_number)->first();
  if(!empty($student)){
    return $student;
  }else{
    return false;
  }
}
function exam_time($exam_id,$subject_id){
  $subject = App\Models\RoutineDetail::where('exam_id',$exam_id)->where('subject_id',$subject_id)->first();
  if(!empty($subject)){
    return $subject;
  }else{
    return false;
  }
}
function total_registration($exam_id,$affiliate_id){
  $total_regi = App\Models\Registration::where('exam_id',$exam_id)->where('affiliate_id',$affiliate_id)->get()->count();
  if(!empty($total_regi)){
    return $total_regi;
  }else{
    return false;
  }
}
function total_formfillupa($exam_id,$affiliate_id){
  $total_regi = App\Models\Registration::where('exam_id',$exam_id)->where('affiliate_id',$affiliate_id)->where('formfillup_payment_status','!=',null)->get()->count();
  if(!empty($total_regi)){
    return $total_regi;
  }else{
    return false;
  }
}
function total_formFillup($exam_id,$affiliate_id){
  $total_formfillup = App\Models\Registration::where('exam_id',$exam_id)->where('affiliate_id',$affiliate_id)->get()->count();
  if(!empty($total_formfillup)){
    return $total_formfillup;
  }else{
    return false;
  }
}
function student_center($exam_id,$affiliate_id){
  $assign = App\Models\AssignAffiliate::where('exam_id',$exam_id)->where('affiliate_id',$affiliate_id)->first();
  if(!empty($assign)){
    return $assign;
  }else{
    return false;
  }
}
function student_affiliate_exam($exam_id,$affiliate_id){
  $assign = App\Models\Registration::where('exam_id',$exam_id)->where('affiliate_id',$affiliate_id)->get();
  if(!empty($assign)){
    return $assign;
  }else{
    return false;
  }
}
function getSession($student_id,$education_level_id){
  $assign = App\Models\Registration::where('student_id',$student_id)->where('education_level_id',$education_level_id)->orderBy('created_at','ASC')->first();
  if(!empty($assign)){
    return $assign;
  }else{
    return false;
  }
}
function subjectWiseResult($subject_id,$roll_number,$registration_number,$exam_id){
  $student_subject = App\Models\Result::where('exam_id',$exam_id)->where('subject_id',$subject_id)->where('registration_number',$registration_number)->where('roll_number',$roll_number)->first();
  //dd($student_subject);
  if(!empty($student_subject)){
    return $student_subject;
  }else{
    return false;
  }
}

  function point_calculation($mark){
       $point = 0;
       if($mark >89){
        $point = 4.0;
       }
       elseif($mark >79){
        $point = 3.5;
       }
       elseif($mark >69){
        $point = 3.0;
       }
       elseif($mark >59){
        $point = 2.5;
       }
       elseif($mark >49){
        $point = 2.0;
       }
       elseif($mark >39){
        $point = 1.5;
       }else{
        $point = 0;
       }
       return $point;
  }



  function gpa_calculation($point){
    $gpa = 'F';
    if($point >=4){
     $gpa = 'A+';
    }
    elseif($point >=3.5){
      $gpa = 'A';
    }
    elseif($point >=3.0){
      $gpa = 'B+';
    }
    elseif($point >=2.5){
      $gpa = 'B';
    }
    elseif($point >=2.0){
      $gpa = 'C';
    }
    elseif($point >=1.5){
      $gpa = 'D';
    }else{
      $gpa = 'F';
    }
    return $gpa;
}
  function gpa_calculation5($point){
    $gpa = 'F';
    if($point >=5){
     $gpa = 'A+';
    }
    elseif($point >=4.5){
      $gpa = 'A';
    }
    elseif($point >=4.0){
      $gpa = 'A-';
    }
    elseif($point >=3.5){
      $gpa = 'B';
    }
    elseif($point >=3.0){
      $gpa = 'C';
    }
    elseif($point >=2.5){
      $gpa = 'D';
    }else{
      $gpa = 'F';
    }
    return $gpa;
}
  function letter_english_calculation($point){
    $gpa = 'Fail';
    if($point >=4){
     $gpa = 'Outsatnding';
    }
    elseif($point >=3.5){
      $gpa = 'Excellent';
    }
    elseif($point >=3.0){
      $gpa = 'Very Good(Grade-1)';
    }
    elseif($point >=2.5){
      $gpa = 'Very Good';
    }
    elseif($point >=2.0){
      $gpa = 'Good';
    }
    elseif($point >=1.5){
      $gpa = 'Acceptable';
    }else{
      $gpa = 'Fail';
    }
    return $gpa;
}



function mark_calculation($mark){
  $gpa = 'F';
  if($mark >89){
   $gpa = 'A+';
  }
  elseif($mark >79){
    $gpa = 'A';
  }
  elseif($mark >69){
    $gpa = 'B+';
  }
  elseif($mark >59){
    $gpa = 'B';
  }
  elseif($mark >49){
    $gpa = 'C';
  }
  elseif($mark >39){
    $gpa = 'D';
  }else{
    $gpa = 'F';
  }
  return $gpa;
}


function arabic_grade_calculation($point){
  $gpa = 'إيف';
  if($point >=4){
   $gpa = '+إي';
  }
  elseif($point >=3.5){
    $gpa = 'إي';
  }
  elseif($point >=3.0){
    $gpa = '+بي';
  }
  elseif($point >=2.5){
    $gpa = 'بي';
  }
  elseif($point >=2.0){
    $gpa = 'سي';
  }
  elseif($point >=1.5){
    $gpa = 'دي';
  }else{
    $gpa = 'إيف';
  }
  return $gpa;
}

function arabic_grade_calculation5($point){
    $gpa = 'إيف';
    if($point >=5){
     $gpa = '+إي';
    }
    elseif($point >=4.5){
      $gpa = 'إي';
    }
    elseif($point >=4.0){
      $gpa = '-إي';
    }
    elseif($point >=3.5){
      $gpa = 'بي';
    }
    elseif($point >=3.0){
      $gpa = 'سي';
    }
    elseif($point >=2.5){
      $gpa = 'دي';
    }else{
      $gpa = 'إيف';
    }
    return $gpa;
  }


function point_calculation5($mark){
    $point = 0;
    if($mark >89){
     $point = 5.0;
    }
    elseif($mark >79){
     $point = 4.5;
    }
    elseif($mark >69){
     $point = 4.0;
    }
    elseif($mark >59){
     $point = 3.5;
    }
    elseif($mark >49){
     $point = 3.0;
    }
    elseif($mark >39){
     $point = 2.5;
    }else{
     $point = 0;
    }
    return $point;
}




function letter_english_calculation5($point){
 $gpa = 'Fail';
 if($point >=5){
  $gpa = 'Outsatnding';
 }
 elseif($point >=4.5){
   $gpa = 'Excellent';
 }
 elseif($point >=4.0){
   $gpa = 'Very Good(Grade-1)';
 }
 elseif($point >=3.5){
   $gpa = 'Very Good';
 }
 elseif($point >=3.0){
   $gpa = 'Good';
 }
 elseif($point >=2.5){
   $gpa = 'Acceptable';
 }else{
   $gpa = 'Fail';
 }
 return $gpa;
}

function letter_arabic_calculation($point){
    $gpa = 'راسب';
      if($point >=4){
       $gpa = 'ممتاز مرتفع';
      }
      elseif($point >=3.50){
        $gpa = 'ممتاز';
      }
      elseif($point >=3.00){
        $gpa = 'جيد جدا مرتفع';
      }
      elseif($point >=2.50){
        $gpa = 'جيد جدا';
      }
      elseif($point >=2.00){
        $gpa = 'جيد';
      }
      elseif($point >=1.50){
        $gpa = 'مقبول';
      }else{
        $gpa = 'راسب';
      }
      return $gpa;
  }

function letter_arabic_calculation5($point){
    $gpa = 'راسب';
    if($point >=5){
     $gpa = 'ممتاز مرتفع';
    }
    elseif($point >=4.50){
      $gpa = 'ممتاز';
    }
    elseif($point >=4.00){
      $gpa = 'جيد جدا مرتفع';
    }
    elseif($point >=3.50){
      $gpa = 'جيد جدا';
    }
    elseif($point >=3.00){
      $gpa = 'جيد';
    }
    elseif($point >=2.50){
      $gpa = 'مقبول';
    }else{
      $gpa = 'راسب';
    }
    return $gpa;
}

function mark_calculation5($mark){
        $gpa = 'F';
        if($mark >89){
        $gpa = 'A+';
        }
        elseif($mark >79){
        $gpa = 'A';
        }
        elseif($mark >69){
        $gpa = 'A-';
        }
        elseif($mark >59){
        $gpa = 'B';
        }
        elseif($mark >49){
        $gpa = 'C';
        }
        elseif($mark >39){
        $gpa = 'D';
        }else{
        $gpa = 'F';
        }
        return $gpa;
}





  function resultCalculator($registration_id,$module_id){
    $regi = App\Models\Registration::with('student')->where('id',$registration_id)->first();

    $total =0;
    $total_point =0;
    $status='';

    if($module_id ==2){
        $subject_total =1;
        if($subject_total >0){
            foreach($regi->subjectjeson as $key=>$subject){
               $subject_result = subjectWiseResult($subject->id,$regi->roll_no,$regi->student->registration_number,$regi->exam_id);
               if($subject_result !=false){
                  $total = $total+  round($subject_result->mark);

                }else{
                    if($subject->id !=162){
                        $status ='Absent';
                     }
                 }
            }
            $total_point = point_calculation5(round($total));
            if($total_point == 0){
                if($status !='Absent'){
                    $status ='Fail';
                }
               }
         }
      }else{
        $subject_total = $regi->subjectjeson->count();
        if($subject_total >0){
            foreach($regi->subjectjeson as $key=>$subject){
               $subject_result = subjectWiseResult($subject->id,$regi->roll_no,$regi->student->registration_number,$regi->exam_id);
               if($subject_result !=false){
                  $total = $total+  round($subject_result->mark);
                  if($regi->education_level_id==13){
                      $point = point_calculation(round($subject_result->mark));
                  }elseif($module_id ==2){
                     $point = point_calculation(round($subject_result->mark));
                  }else{
                     $point = point_calculation5(round($subject_result->mark));
                  }
                  if($point == 0){
                   if($subject->id !=162){
                      $status ='Fail';
                   }
                  }
                  $total_point =$total_point+$point;
                }else{
                   $status ='Absent';
                 }

            }
         }
      }

   $cpga = $total_point / $subject_total;
   if($regi->education_level_id==13){
    $gpa = gpa_calculation($cpga);
    }else{
        $gpa = gpa_calculation5($cpga);
    }

   $data =array();
   if($regi->exfail =='1'){
    $data['point'] = 0;
    $data['gpa'] ='বহিষ্কৃত';
   }elseif($regi->whith_hell ==1){
    $data['point'] = 0;
    $data['gpa'] ='স্থগিত';
   }elseif($status =='Absent'){
    $data['point'] = 0;
    $data['gpa'] ='অনুপস্থিত';
   }elseif($status =='Fail'){
    $data['point'] = 0;
    $data['gpa'] ='F';
   }else{
    $data['point'] = number_format((float)$cpga, 2, '.', '');
    $data['gpa'] = $gpa;
   }

   $data['total'] = $total;
   return $data;
  }

  function resultCalculatorTop($roll_no,$exam_id,$module_id=null){
    $regi = App\Models\Registration::with('student')->where('roll_no',$roll_no)->where('exam_id',$exam_id)->first();
    $total =0;
    $total_point =0;
    $status='';
    if($module_id ==2){
      $subject_total =1;
      if($subject_total >0){
        foreach($regi->subjectjeson as $key=>$subject){
           $subject_result = subjectWiseResult($subject->id,$regi->roll_no,$regi->student->registration_number,$regi->exam_id);
           if($subject_result !=false){
              $total = $total+round($subject_result->mark);

            }else{
                if($subject->id !=162){
                    $status ='Absent';
                 }
             }
        }
        $total_point = point_calculation5($total);
        if($total_point == 0){
               $status ='Fail';
           }
     }
    }else{
      $subject_total = $regi->subjectjeson->count();
      if($subject_total >0){
        foreach($regi->subjectjeson as $key=>$subject){
           $subject_result = subjectWiseResult($subject->id,$regi->roll_no,$regi->student->registration_number,$regi->exam_id);
           if($subject_result !=false){
              $total = $total+round($subject_result->mark);
              if($regi->education_level_id==13){
                  $point = point_calculation(round($subject_result->mark));
              }else{
                 $point = point_calculation5(round($subject_result->mark));
              }
              if($point == 0){
             //   if($subject->id ==162){
             //      $status ='Fail';
             //   }
               $status ='Fail';
              }
              $total_point =$total_point+$point;
            }else{
               $status ='Absent';
             }

        }
     }
    }


   $cpga = $total_point / $subject_total;
   if($regi->education_level_id==13){
    $gpa = gpa_calculation($cpga);
    }else{
        $gpa = gpa_calculation5($cpga);
    }

   $data =array();
   if($regi->exfail =='1'){
    $data['point'] = 0;
    $data['gpa'] ='বহিষ্কৃত';
   }elseif($regi->whith_hell ==1){
    $data['point'] = 0;
    $data['gpa'] ='স্থগিত';
   }elseif($status =='Absent'){
    $data['point'] = 0;
    $data['gpa'] ='অনুপস্থিত';
   }elseif($status =='Fail'){
    $data['point'] = 0;
    $data['gpa'] ='F';
   }else{
    $data['point'] = number_format((float)$cpga, 2, '.', '');
    $data['gpa'] = $gpa;
   }

   $data['total'] = $total;
   return $data;
  }

  function exam_madrasa_report($exam_id,$affiliate_id){
    $ap =0;
    $a =0;
    $bp =0;
    $b =0;
    $c =0;
    $d =0;
    $f =0;
    $total =0;
    $present =0;
    $absent =0;
    $expelled =0;
        $exam = App\Models\Exam::where('id',$exam_id)->first();
        $registrations =App\Models\Registration::where('exam_id',$exam_id)->where('affiliate_id',$affiliate_id)->get();
        $results = App\Models\Result::where('exam_id',$exam_id)->where('affiliate_id',$affiliate_id)->groupBy('roll_number')->get();
        $total = $registrations->count();
        $present = $results->count();
       // $absent = $total  -  $present;
        foreach ($registrations as $item){
          if($item->exfail == '1'){
            $expelled =$expelled+1;
        }else{
            $result = resultCalculator($item->id,$exam->module_id);
            if($result['gpa'] == 'A+'){$ap =$ap+1;
            }elseif($result['gpa'] == 'A'){   $a =$a+1;
            }elseif($result['gpa'] == 'B+'){ $bp =$bp+1;
            }elseif($result['gpa'] == 'B'){$b =$b+1;
            }elseif($result['gpa'] == 'C'){$c =$c+1;
            }elseif($result['gpa'] == 'D'){$d =$d+1;
            }elseif($result['gpa'] == 'F'){$f =$f+1;
            }elseif($result['gpa'] == 'অনুপস্থিত'){$absent =$absent+1;}
          }
         }

    $data['total'] = $total;
    $data['present'] = $present;
    $data['absent'] = $absent;
    $data['ap'] = $ap;
    $data['a'] = $a;
    $data['bp'] = $bp;
    $data['b'] = $b;
    $data['c'] = $c;
    $data['d'] = $d;
    $data['f'] = $f;
    $data['expelled'] = $expelled;
    return $data;
  }


  function resultTotalMark($paper_number,$roll_number){
    $regi = App\Models\Registration::where('paper_number',$paper_number)->where('roll_no',$roll_number)->first();
    $total =0;
      foreach($regi->subjectjeson as $key=>$subject){
        $subject_result = subjectWiseResult($subject->id,$regi->roll_no,$regi->student->registration_number,$regi->exam_id);
        if($subject_result !=false){
            $total = $total+  round($subject_result->mark);
          }

      }
   $data['bangla_name'] = $regi->student->bangla_name;
   $data['father_bangla_name'] = $regi->student->father_bangla_name;
   $data['affiliate_name'] =$regi->student->affiliation->bangla_name;
   $data['total'] = $total;
   return $data;
  }
function day_convertion($day){
      $bnday ='';
       if($day =='Sat'){
        $bnday ='শনিবার';
       }
       if($day =='Sun'){
        $bnday ='রবিবার';
       }
       if($day =='Mon'){
        $bnday ='সোমবার';
       }
       if($day =='Tue'){
        $bnday ='মঙ্গলবার';
       }
       if($day =='Wed'){
        $bnday ='বুধবার';
       }
       if($day =='Thu'){
        $bnday ='বৃহস্পতিবার';
       }
       if($day =='Fri'){
        $bnday ='শুক্রবার';
       }
       return $bnday;
}
function user_img($path = null){
    if($path){
        if(file_exists(public_path().$path)){
            return $path;
        }
    }

    return '/img/user.png';
}

function cover_img($path = null){
    if($path){
        if(file_exists(public_path().$path)){
            return $path;
        }
    }

    return '/img/cover-img.png';
}


function sendMail($email, $text){
  \Mail::to($email)->send(new \App\Mail\MyTestMail($text));
}
function translate($val){
  return $val;
}

// send sms
// function sendSms($number, $text){
//   $url = "http://66.45.237.70/api.php";
//   $data= array(
//       'username'=>"mrashk197",
//       'password'=>"MeCpFe100$",
//       'number'=>"$number",
//       'message'=>"$text"
//   );

//   $ch = curl_init();
//   curl_setopt($ch, CURLOPT_URL,$url);
//   curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
//   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//   $smsresult = curl_exec($ch);
//   $p = explode("|",$smsresult);
//   $sendstatus = $p[0];
//   return $sendstatus;
// }


function sms_send($number,$message) {
    $url = "http://bulksmsbd.net/api/smsapi";
    $api_key = "K9H6k6kXhBy7dw39on2f";
    $senderid = "8809617627306";
    $number = $number;
    $message = $message;
    $data = [
        "api_key" => $api_key,
        "senderid" => $senderid,
        "number" => $number,
        "message" => $message
    ];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
     $response = curl_exec($ch);    curl_close($ch);
      return $response;
    }

if(!function_exists('bn2en')){

    function bn2en($number)
    {
        $bn_number = ["১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০"];
        $en_number = ["1", "2", "3", "4", "5", "6", "7", "8", "9", "0"];

        return str_replace($bn_number, $en_number, $number);
    }
}

if(!function_exists('en2bn')){

    function en2bn($number)
    {
        $bn_number = ["১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০"];
        $en_number = ["1", "2", "3", "4", "5", "6", "7", "8", "9", "0"];

        return str_replace($en_number, $bn_number, $number);
    }
}


if(!function_exists('en2arabic')){

  function en2arabic($number)
  {
      $arabic = ['٠','١','٢','٣','٤','٥','٦','٧','٨','٩'];
      $en_number = ['0','1','2','3','4','5','6','7','8','9'];

      return str_replace($en_number, $arabic, $number);
  }
}


if(!function_exists('en2arabic')){

  function en2arabic($number)
  {
      $arabic = ['0','1','2','3','4','5','6'];
      $en_number = ['A+','A','B+','B','C','D','F'];

      return str_replace($en_number, $arabic, $number);
  }
}


if(!function_exists('bn2en_only')){

    function bn2en_only($number)
    {
        $bn_number = ["১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০"];
        $en_number = ["1", "2", "3", "4", "5", "6", "7", "8", "9", "0"];

        $string = str_replace($bn_number, $en_number, $number);

        $number = preg_replace('/[^0-9 ."\']/',null, $string);
        if($number == ''){
            return null;
        }
        return $number;
    }
}

function active_route($routes){

    $route_name = \Request::route()->getName();

    if(in_array($route_name, $routes)){
        return 'mm-active';
    }
    return '';
}
function active_expanded($routes){

    $route_name = \Request::route()->getName();

    if(in_array($route_name, $routes)){
        return 'true';
    }
    return 'false';
}


function gpaCalculationArbi($point){
    $gpa = 'راسب';
    if($point >=4){
     $gpa = 'ممتاز مرتفع';
    }
    elseif($point >=3.50){
      $gpa = 'ممتاز';
    }
    elseif($point >=3.00){
      $gpa = 'جيد جدا مرتفع';
    }
    elseif($point >=2.50){
      $gpa = 'جيد جدا';
    }
    elseif($point >=2.00){
      $gpa = 'جيد';
    }
    elseif($point >=1.50){
      $gpa = 'مقبول';
    }else{
      $gpa = 'راسب';
    }
    return $gpa;
}


function date_maker($date, $format)
{

    if ($date == null) {
        return '00:00';
    }
    return date_format(date_create($date), $format);
}

function bangla_month($date)
{
    $month = date_maker($date, 'm');
    $bangla_month = ['জানুয়ারী', 'ফেব্রুয়ারী', 'মার্চ', 'এপ্রিল', 'মে', 'জুন', 'জুলাই', 'আগস্ট', 'সেপ্টেম্বর', 'অক্টোবর', 'নভেম্বর', 'ডিসেম্বর'];
    $minus_index = ($month - 1);
    return $bangla_month[$minus_index];
}

function bangla_year($date)
{
    $month = date_maker($date, 'Y');

    return bangla_number($month);
}

function bangla_number($number)
{
    if (!is_numeric($number)) {
        return $number;
    }
    $bangla_number = new NumberToBangla();
    return $bangla_number->bnNum($number);
}
function bangla_bnWord($number)
{
    if (!is_numeric($number)) {
        return $number;
    }
    $bangla_number = new NumberToBangla();
    return $bangla_number->bnWord($number);
}
function bangla_month_year($date){
    return bangla_month($date)." ".bangla_year($date);
}

function bangla_date_month_year($date){
    return bangla_number(date_maker($date,'d' )).' '.bangla_month($date).", ".bangla_year($date);
}

