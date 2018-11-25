<?php
function data_fetch($db,$jobcode)
{
    $output = "";
    $result1 = mysqli_query($db, "SELECT id FROM apply_details where JobCode = '$jobcode'");
    while ($row1 = mysqli_fetch_array($result1)) {

        $id = $row1['id'];
        $result2 = mysqli_query($db, "SELECT * FROM users where id = '$id'");
        while ($row2 = mysqli_fetch_array($result2)) {
           $output .=' <tr>
                <td>'.$row2['id'] .'</td>
                <td>'.$row2['username'].'</td>
                <td>'.$row2['email'].'</td>
                <td>'.$row2['gender'].'</td>
                <td>'.$row2['tel'].'</td>
                <td>'.$row2['address'].'</td>
            </tr>';
        }
    }
    return $output;
}
function data_fetch2($db,$id)
{
    $output ="";
    $result1 = mysqli_query($db, "SELECT JobCode FROM apply_details where id = '$id'");
    while ($row1 = mysqli_fetch_array($result1)){

        $JobCode = $row1['JobCode'];
        $result2 = mysqli_query($db, "SELECT * FROM vacancies where JobCode = '$JobCode'");
        while($row2 = mysqli_fetch_array($result2)) {
            $output .= ' <tr>
                <td>'.$row2['JobCode'].'</td>
                <td>'.$row2['position'].'</td>
                <td>'.$row2['ClosingDate'].'</td>
                <td>'.$row2['description'].'</td>
            </tr>';
        }
    }
    return $output;
}