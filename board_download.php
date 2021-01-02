<?php
    //인코딩방식 UTF-8 & UTF-8 BOM 설정구분하기!
    //alert()창이 있는곳이 문제가 발생(한글이 깨진다는 단점이 있음)하여 php파일 중에서 alert()창의 스크립트가 포함된 곳
    //#1. php파일 alert() 창을 제거
    //#2.alert()창이 반드시 존재해야하는 곳에서는 utf-8 with Bom -> 스타일로 통제
    //#3. var_dump(변수명) : 개발단계에서 내부 내용 확인시에만 utf-8 with Bom을 사용. 확인이 완료되면 utf-8으로 변경
    //***파일 다운로드에서는 utf-8 bom 설정이면 파일이 깨져서 다운로드 안되므로 utf-8로 설정하자 */

    //board_download.php?num=$num&real_name=$real_name&file_name=$file_name&file_type=$file_type


    $real_name = $_GET["real_name"];
    $file_name = $_GET["file_name"];
    $file_type = $_GET["file_type"];
    $file_path = "./data/".$real_name;  // ./data/2020_09_09_10_15_09.png

    //file_exists() 함수 : 지정한 경로에 파일이 존재하는지에 대한 유무를 판단. 파일이 존재한다면 1(true), 파일이 존재하지 않는다면 0(false)
    //$fp = file path
    if(file_exists($file_path)){

        //fopen() 함수 : 파일을 열어주겠다는 함수(외부파일)
        //fopen(파일명 또는 파일에 대한 변수, 파일모드, includepath)
        /*
        fopen()의 파일 모드
            w : 파일을 쓰기 전용
            r : 파일을 읽고 쓰기 전용
            b : 바이너리 데이터 (컴퓨터 상에서 코딩상으로 구조화된 상태의 데이터 값)

            ex)rb : 겹쳐서 써도됨, 읽고 쓰겠다
        */
        //fclose() 함수 : 파일을 닫아주겠다는 함수
        $fp = fopen($file_path, "rb");
        /*
        Header() 함수 : HTTP 헤더를 전송하기 위해 사용
        HTML 문서상에서 <meta Content-type="equiv"> (파일을정의)
        */
    
        Header("Content-type:application/x-msdownload"); //강제로 다운로드 시켜주게끔 만들어주는 정의문
        //application: "앱"은 DB와 연동이 되면서 하나 이상의 동작을 수행시켜주는 형태를 모두 지칭. 예를들어서 날씨정보를 API(Application Programming Interface)로부터 받아서 표현한 것도 application의 일종. 이미지, 문서형태, 비디오, 오디오 등을 통칭

        //이미지 파일을 다운로드 : Header("Content-type:image/gif/x-msdownload");
        Header("Content-Length:".filesize($file_path));   //파일의 용량(사이즈)을 전송
        Header("Content-Disposition:attachment; filename=".$file_name);  //파일의 오리지널 이름을 전송
        Header("Content-Transfer-Encoding:binary");  //인코딩방식을 전송
        Header("Content-Description: File Transfer");  //파일에 대한 개요를 변형된 형태로 전송
        //header("Content-Type: image/png");
        Header("Expires:0");  //만료일에 대한 전송. "0"이라는 의미는 이미 만료가 되었다는 의미 -> http로 전송간에 캐싱을 캐시메모리(캐싱)에 만료일을 존재하지  않게끔 하겠다는 의미 -> http로 전송간에 캐싱을 하지 않도록 선언 

        //캐시메모리 : 브라우저에서 화면을 여는 과정상에서 이미지를 다운 받아서 잠시 저장하는 공간에 넣음. 만약 서버에 (이미지 또는 스타일 또는 스크립트)파일을 저장을 했다가 내부에서 변경하는 파일을 다시 던졌을 때, 로딩을 거쳐야 하는데, 캐시메모리 상에 기존 파일이 존재한다면 화면 변경이 없음. 페이스북 마케팅에서 각 회사의 상단 이미지를 변경할 때는 바로 바뀌지 않는 경우가 있음 -> 캐시메모리에서 이전에 등록한 이미지를 변경하지 않은 경우 (서버를 restart 하기 전까지는 캐시메모리가 그대로 남아 있음)
    }


    //passthru(변수명) : 외부파일을 전체 읽을 수 있는 함수 숫자형데이터가 결과로 도출 , 화면을 실시간출력
    if(!fpassthru($fp)){   //읽을 수 있는 파일이 없다면
        fclose($fp);    //파일을 닫아주겠다는 의미
    }

    //외부파일 다운로드 단계
    //fopen(변수명) -> fread(변수명) -> fclose(변수명) : 약간의시간이 소요
    //따라서 한번에 잡는 방법이 있음
    //fopen(변수명) -> fpassthru(변수명) : "fread(변수명) -> fclose(변수명)"를 무시하고 바로 진행을 시킴으로써 fread(변수명)에서 시간이 Delay되는 부분을 건너뛴다.






?>