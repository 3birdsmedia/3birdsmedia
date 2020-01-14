<?php function dbConnect($type) {
        if ($type == 'query') {
            $user = 'fixieQuery';
            $pwd = 'qwer77';
        } elseif ($type == 'admin') {
            $user = 'fixieAdmin';
            $pwd = 'asdf77';
        }else{
            exit('Unrecognized connection type');
        }

        $conn = new mysqli('localhost', $user, $pwd, 'fixieDB')
        or die ('Cannot open database');
        return $conn;
    }
    
    function dbClose($conn) {
	mysqli_close($conn);
}
?>