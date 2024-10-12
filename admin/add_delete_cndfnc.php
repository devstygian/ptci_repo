<?php
function addCandidate($conn, $cand_no, $fullName, $courseId, $teamId, $gender) {
    $stmt = $conn->prepare("INSERT INTO candidates (cand_no, cand_fn, cand_course, cand_team, cand_gender) VALUES (?, ?, ?, ?, ?)");
    if (!$stmt) {
        return "Error preparing statement: " . $conn->error;
    }
    
    $courseIdInt = (int)$courseId;
    $teamIdInt = (int)$teamId;

    $stmt->bind_param("ssiis", $cand_no, $fullName, $courseIdInt, $teamIdInt, $gender);
    
    if ($stmt->execute()) {
        return "Candidate added successfully.";
    } else {
        return "Error: " . $stmt->error;
    }
}

function deleteCandidate($conn, $id) {
    $stmt = $conn->prepare("DELETE FROM candidates WHERE cand_id = ?");
    if (!$stmt) {
        return "Error preparing statement: " . $conn->error;
    }
    
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        return "Candidate deleted successfully.";
    } else {
        return "Error: " . $stmt->error;
    }
}

function fetchCandidates($conn) {
    $query = "
        SELECT c.cand_id, c.cand_no, c.cand_fn, cr.crs_name AS cand_course, t.tm_name AS cand_team, c.cand_gender
        FROM candidates c
        JOIN course cr ON c.cand_course = cr.crs_id
        JOIN teams t ON c.cand_team = t.tm_id
    ";
    
    $result = $conn->query($query);
    if (!$result) {
        return [];
    }
    return $result->fetch_all(MYSQLI_ASSOC);
}
?>
