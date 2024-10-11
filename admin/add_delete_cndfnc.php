<?php
function addCandidate($conn, $cand_no, $fullName, $course, $teamId, $gender) {
    $stmt = $conn->prepare("INSERT INTO candidates (cand_no, cand_fn, cand_course, cand_team, cand_gender) VALUES (?, ?, ?, ?, ?)");
    if (!$stmt) {
        return "Error preparing statement: " . $conn->error;
    }
    
    $stmt->bind_param("ssiis", $cand_no, $fullName, $course, $teamId, $gender);
    
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
    $result = $conn->query("SELECT * FROM candidates");
    if (!$result) {
        return [];
    }
    return $result->fetch_all(MYSQLI_ASSOC);
}
?>
