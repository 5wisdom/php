<?php 

    //흐름 form -> js -> insert.php -> 첨부파일

    //세션에 대한 등록값이 존재하는지에 대해 
    session_start();
    if(isset($_SESSION["userid"])){
        $userid = $_SESSION["userid"];
    }else{
        $userid = "";
    }
    if(isset($_SESSION["username"])){
        $username = $_SESSION["username"];
    }else{
        $username = "";
    }

    /*
    if(!$userid){ //로그인 상태가 아님
        echo ("
            <script>
                alert('로그인 후 이용 바랍니다.');
                location.href='./login_form.php';
            </script>
        ");
        exit;
    }
    */

    $subject = $_POST["subject"];
    $content = $_POST["content"];
    $regist_day = date("Y-m-d (H:i)");


    //node에서 mkdir:파일생성
    //DATA파일: 첨부파일을 저장하는 공간


    //첨부파일을 단순히 보내면 fakepath로 보내짐 -> 따라서 경로만들자
    //자바스크립에서 배열에서 빼옴
    $upload_dir = "./data/"; //저장공간 디렉토리 정의
    $upfile_name = $_FILES["upfile"]["name"]; //첨부파일이 갖고 있는 실제 이름
    $upfile_tmp_name = $_FILES["upfile"]["tmp_name"];//첨부파일에 부여된 일시적 다른이름 저장
    $upfile_type = $_FILES["upfile"]["type"]; //파일형태
    $upfile_size = $_FILES["upfile"]["size"]; //파일사이즈
    $upfile_error = $_FILES["upfile"]["error"];  //에러사항

    //내가 첨부한 파일에 대한 정보
    var_dump($upfile_name); //string(5) "1.png"
    var_dump($upfile_tmp_name); //string(14) "/tmp/phpUtFXQo" -> fake path 같은것(이것을 ./data로 옮겨야함)
    var_dump($upfile_type); //string(9) "image/png" 
    var_dump($upfile_size); //int(11805) -바이트
    var_dump($upfile_error); // int(0) - 에러없음


    if($upfile_name && !$upfile_error){//이름이 있고 에러가 없을때
        //파일의 이름이 main_bg.jpg라면 
        $file = explode(".", $upfile_name);   //지정한 문자를 기준으로 문자열을 배열화시킨다 
        $file_name = $file[0]; //파일이름
        $file_ext = $file[1]; //확장자
        
        //동일한 이름의 이미지 파일이 존재하지 않도록 구성(업데이트 날짜를 포함)

        $new_file_name = date("Y_m_d_H_i_s");
        $copied_file_name = $new_file_name.".".$file_ext;
        $uploaded_file = $upload_dir.$copied_file_name; //경로+월일년시분초

        
 

        var_dump($uploaded_file);
        //3MB이상 업로드 하지 못하게 막음
        if($upfile_size > 3000000){
            echo ("
                <script>
                    alert('업로드한 파일의 크기가 5MB를 초과하였습니다. \n파일 사이즈를 체크해주시기 바랍니다.');
                    history.go(-1);
                </script>
            ");
            exit;
        }

        //실제 데이터베이스를 기반으로 지정된 장소에 파일을 저장
        //move_uploaded_file() 함수로 서버에 임시저장 된 $uploaded_file의 값인 경로/파일명 형태로 저장. 업로드 파일명이 중복되는 것을 피할 수있음
        //move_uploaded_file(file)(file, newlocation) : 업로드된 파일을 새로운 위치의 파일(경로포함)로 이동한다.
        //file - 업로드된 파일의 임시파일 / newlocation :경로를 포함한 파일명 + 확장자명

        //move_uploaded_file($upfile_tmp_name,$uploaded_file); //fake path에 임시저장된파일을 경로이동시킴
        //move_uploaded_file($upfile_tmp_name,$uploaded_file)를 먼저 실행하고 아니라면(!) if문 아래를 실행시켜줘~ 
        if(!move_uploaded_file($upfile_tmp_name, $uploaded_file)){//boolean
            echo("
                <script>
                    alert('파일을 지정한 디렉토리에 옮기는 것을 실패했습니다.');
                    history.go(-1);
                </script>
            ");
            exit;
        }


    }else{ //만족하지 못했을때는 파일이 깨졌던지 이상이 있을때이므로 값을 비워놔
        $upfile_name = "";
        $upfile_type = "";
        $copied_file_name ="";
        
    }

    include "./db_con.php"; //$con

    //board_form.php으로부터 전달받은 값들을 board라는 테이블 데이터 베이스에 저장
    //hit는 수학적값으로 사용자가 클릭하면 숫자가 올라가도록 만들예정
    $sql = "insert into board (id, name, subject, content, regist_day, hit, file_name, file_type, file_copied) ";
    $sql .= "values('$userid', '$username', '$subject', '$content', '$regist_day', 0, '$upfile_name', '$upfile_type', '$copied_file_name')";
    mysqli_query($con, $sql);  //$sql에 저장된 명령실행(데이터 베이스로 넣겠다)

    //활동에 따른 포인트를 부여
    $point_up = 100;

    //members라는 테이블로부터 포인트에 대한 항목만 가져와서 변경
    $sql = "select * from members where id='$userid'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    $new_point = $row["point"] + $point_up;  //누적

    //변경된 포인트의 값을 신규로 업데이트하겠다는 의미
    $sql = "update members set point=$new_point where id='$userid'"; //memebers테이블에서 업데이트 시키는데 id가 같다면 포인트값을 세팅해라
    mysqli_query($con, $sql);
    mysqli_close($con);

    echo ("
        <script>
            location.href = 'board_list.php';
        </script>
    ");
    

?>