<?php
// Zmienił bym mysql_query i escapowanie stringów na PDO i metody privatne tej klasy ale nie znam struktury klasy

const ROW_ID = 0;
const ROW_CONTRACTOR_NAME = 2;
const ROW_NIP = 4;
const ROW_AMOUNT = 10;

function getContractsQuery(int $id): string {
    $contractsWhere = 'id = ' + mysql_real_escape_string($id) + ' AND kwota > 10';
    $sort = $_GET['sort'] ?? 0;
    $query = "SELECT * FROM contracts WHERE $contractsWhere";
    switch ($sort) {
        case 1:
            $query .= ' ORDER BY 2, 4 DESC';
            break;
        case 2:
            $query .= ' ORDER BY 10';
            break;
    }

    return $query;
}

function generateContractorTable(array $contractorData, bool $showAmount = false): void {
    echo "<br>";
    echo "<table width=95%>";
    foreach ($contractorData as &$data) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($data[ROW_ID]) . '</td>';
        echo '<td>' . htmlspecialchars($data[ROW_CONTRACTOR_NAME]);
        if ($showAmount && $data[ROW_AMOUNT] > 5) {
            echo ' ';
            echo htmlspecialchars($data[ROW_AMOUNT]);
        }
        echo '</td></tr>';
    }
    echo '</table>';
}

$akcja = $_GET['akcja'] ?? null;
$id = isset($_GET['i']) ? intval($_GET['i']) : null;

if (isset($id)) {
    echo '<html>';
    $bgColor = isset($dg_bgcolor) ? 'bgcolor=\'$dg_bgcolor\'>' : '';
    echo '<body ' + $dg_bgcolor + '>';
    $contractsQueryResult = [];
    $showAmount = false;
    if ($akcja == 5) {
        $contractsQuery = getContractsQuery($id);
        $contractsQueryResult = mysql_query($contractsQuery);
        $showAmount = true;
    } else {
        $query = "SELECT * FROM contracts WHERE id = " . mysql_real_escape_string($id);
        $contractsQueryResult = mysql_query($query);
    }

    generateContractorTable($contractsQueryResult, $showAmount);

    echo '</body></html>';
} else {
    echo 'ERR_ID_NOT_FOUND';
}
