<html>

<body>
    <?php
    //1. php로 DB 저장 과정 보이기
    //2. 서버 정보 분석한거 적기
    //워드만 올리기 
    
    //DB 접속하기 
    echo "<br/>";
    $mysqli = new mysqli("164.125.36.78", "202055565", "202055565", "db","3306");
    if ($mysqli->connect_errno){
        die("Failed to connect to MySQL");
    }
    else{
        echo "Connect to MySQL !!";
    }

    //DB 내 students 이라는 테이블 생성하기 
    echo "<br/>";
    
    $sql = "CREATE TABLE students(
        id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        studentID VARCHAR(30),
        name VARCHAR(30),
        phonenum VARCHAR(30),
        reg_date TIMESTAMP
    )";
    
    if ($mysqli->query($sql)===TRUE){
        echo "Table Example created successfully";
    }else {
        // 이미 테이블이 존재한다면 error 메세지를 출력
        echo "Error creating table".$mysqli->error;
    }
    
    //DB에 post로 데이터 추가 => 개인 정보를 php로 데이터베이스에 저장
    echo "<br/>";
    if ($mysqli->query("insert into students set studentID = '".$_POST['studentID']."', 
    name = '".$_POST['name']."', phonenum = '".$_POST['phonenum']."'")!==TRUE)
    {
        die("Failed to Insert Data");
    }
    echo "1 record added.<br/><br/>";

?>


    <table border=1>
        <tr>
            <td>학번</td>
            <td>이름</td>
            <td>휴대폰번호</td>
        </tr>


        <?php
        
    //DB에서 데이터 선택하여 출력하기 
    if ($result = $mysqli->query("select * from students")) {
        //결과를 1 row 단위로 얻어와서 출력
        while ($data = $result->fetch_array()){
            echo "<tr>";
            echo "<td>".$data['studentID']."</td>";
            echo "<td>".$data['name']."</td>";
            echo "<td>".$data['phonenum']."</td>";
            echo "</tr>";
        }
        //결과 객체를 해제
        $result->close();
        //DB 연결을 해제
        $mysqli->close();
    }



?>
    </table>

    <?php
    //$_SERVER, $_ENV 의 자료 출력하여 내용 분석하기 

    //$_SERVER 정보 출력하기 
    echo "<h2>SERVER</h2>";
    foreach($_SERVER as $key => $value) { 
        print("<P> $key is $value </P>");
    }
    //$_ENV 정보 출력하기 
    echo "<h2>ENV</h2>";
    foreach($_ENV as $key => $value) { 
        print("<P> $key is $value </P>");
    }
    //지금은 출력이 안됨
    // foreach($_ENV as $key => $value) { 
    //     print("<P> $key is $value </P>");
    // }

?>

</body>

</html>