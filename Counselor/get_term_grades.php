<?php
session_start();
header('Content-Type: application/json');
require_once '../config/config.php';

$response = ['success' => false, 'labels' => [], 'values' => [], 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $response['message'] = 'Invalid request method';
    echo json_encode($response);
    exit;
}

$termId = isset($_POST['term_id']) ? (int)$_POST['term_id'] : 0;
$studentId = isset($_SESSION['student_id']) ? (int)$_SESSION['student_id'] : 0;

if (!$termId || !$studentId) {
    $response['message'] = 'Missing term or student id';
    echo json_encode($response);
    exit;
}

try {
    $query = 'SELECT g.grade_subject, g.score FROM grades g WHERE g.student_id = ? AND g.term_id = ? ORDER BY g.id';
    $stmt = $conn->prepare($query);
    $stmt->execute([$studentId, $termId]);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($rows && count($rows) > 0) {
        $labels = array_map(function($r){ return $r['grade_subject'] ?: 'Unknown'; }, $rows);
        $values = array_map(function($r){ return (int)$r['score']; }, $rows);

        $response['success'] = true;
        $response['labels'] = $labels;
        $response['values'] = $values;
    } else {
        $response['message'] = 'No grades for this term';
    }
} catch (PDOException $e) {
    $response['message'] = 'DB error';
    error_log('get_term_grades error: ' . $e->getMessage());
}

echo json_encode($response);
