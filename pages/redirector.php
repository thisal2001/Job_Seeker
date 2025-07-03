<?php

session_start();

// if(!isset($_SESSION['role'])){
//     header('Location: /jobseeker');
// }

switch ($_SESSION['role']) {
    case 'admin':
        header("Location: /jobseeker/pages/admin/index.php?msg=Sorry%20you%20can't%20access%20that%20page.");
        break;
    
    case 'candidate':
        header("Location: /jobseeker/pages/candidate/index.php?msg=Sorry%20you%20can't%20access%20that%20page.");
        break;
    
    case 'recruiter':
        header("Location: /jobseeker/pages/recruiter/index.php?msg=Sorry%20you%20can't%20access%20that%20page.");
        break;
    
    default:
        header('Location: /jobseeker');
        break;
}