<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Raporty Faktur</title>
    <link rel="stylesheet" href="styles/styles.css">
    <script src="scripts/index.js" defer></script>
</head>
<body>

    <div id="top-menu" class="top-menu">
        <button onclick="loadNewReport('overpayments')" class="menu-button">Raport nadpłat</button>
        <button onclick="loadNewReport('underpayments')" class="menu-button">Raport niedopłat</button>
        <button onclick="loadNewReport('unpaid_invoices')" class="menu-button">Nierozliczone faktury</button>
    </div>

    <div id="filters" class="filters">
        <label for="clientName">Wyszukaj po kliencie:</label>
        <input type="text" id="clientName" placeholder="Wprowadź nazwę klienta" class="filter-input">
        
        <label for="startDate">Data początkowa:</label>
        <input type="date" id="startDate" class="filter-input">
        
        <label for="endDate">Data końcowa:</label>
        <input type="date" id="endDate" class="filter-input">
        
        <label for="minAmount">Kwota minimalna:</label>
        <input type="number" id="minAmount" placeholder="Kwota minimalna" class="filter-input">

        <label for="maxAmount">Kwota maksymalna:</label>
        <input type="number" id="maxAmount" placeholder="Kwota maksymalna" class="filter-input">
        
        <button onclick="searchReports()" class="search-button">Szukaj</button>
    </div>

    <div id="reportContainer" class="report-container">
        <!-- Tabela z raportem generowana dynamicznie -->
    </div>

</body>
</html>
