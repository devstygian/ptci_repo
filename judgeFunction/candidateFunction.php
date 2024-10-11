<?php
// Global function for getting male candidates
function getMaleCandidates($conn) {
    $sql = "SELECT cand_no, cand_fn, cand_ln, cand_course, cand_team FROM candidates WHERE cand_gender = 'Male'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $candidates = [];
        while ($row = $result->fetch_assoc()) {
            $candidates[] = $row;
        }
        return $candidates;
    } else {
        return [];
    }
}
?>
