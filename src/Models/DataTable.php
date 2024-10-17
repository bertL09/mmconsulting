<?php
namespace Models;

class DataTable
{
    private array $data;
    private string $sortColumn;
    private string $sortOrder;

    public function __construct(array $data, string $sortColumn = '', string $sortOrder = 'ASC')
    {
        $this->data = $data;
        $this->sortColumn = $sortColumn;
        $this->sortOrder = strtoupper($sortOrder) === 'DESC' ? 'DESC' : 'ASC';
    }

    public function generateTable(): string
    {
        if (empty($this->data)) {
            return "<p>Brak danych do wyświetlenia.</p>";
        }

        if ($this->sortColumn) {
            usort($this->data, function ($a, $b) {
                $column = $this->sortColumn;
                if ($this->sortOrder === 'ASC') {
                    return $a[$column] <=> $b[$column];
                } else {
                    return $b[$column] <=> $a[$column];
                }
            });
        }

        $html = '<table class="report-table"><thead><tr>';

        foreach (array_keys($this->data[0]) as $column) {
            $sortClass = 'sort-' . strtolower($column);
            $orderClass = ($this->sortColumn === $column) ? 'sorted-' . strtolower($this->sortOrder) : '';
            $html .= "<th class='sort $sortClass $orderClass' data-column='$column'>{$column}</th>"; // Może dodałbym tłumaczenie jakbym miał więcej czasu bo teraz nie ładnie wygląda a jednak chcę żeby było uniwersalne
        }
        
        $html .= '</tr></thead><tbody>';

        foreach ($this->data as $index => $row) {
            $rowClass = ($index % 2 === 0) ? 'row-even' : 'row-odd';
            $html .= "<tr class='$rowClass'>";
            foreach ($row as $value) {
                $html .= "<td>" . htmlspecialchars($value) . "</td>";
            }
            $html .= '</tr>';
        }
        
        $html .= '</tbody></table>';
        
        return $html;
    }
}
