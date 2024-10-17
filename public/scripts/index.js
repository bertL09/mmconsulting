var reportType;
var currentSortColumn = '';
var currentSortOrder = 'ASC';

 loadContent = (report) => {
    reportType = report;
    let clientName = document.getElementById('clientName').value;
    let startDate = document.getElementById('startDate').value;
    let endDate = document.getElementById('endDate').value;
    let minAmount = document.getElementById('minAmount').value;
    let maxAmount = document.getElementById('maxAmount').value;

    let url = `reports.php?report=${reportType}`;
    if (clientName) url += `&clientName=${encodeURIComponent(clientName)}`;
    if (startDate) url += `&startDate=${encodeURIComponent(startDate)}`;
    if (endDate) url += `&endDate=${encodeURIComponent(endDate)}`;
    if (minAmount) url += `&minAmount=${encodeURIComponent(minAmount)}`;
    if (maxAmount) url += `&maxAmount=${encodeURIComponent(maxAmount)}`;
    if (currentSortColumn.length > 0) {
        url += `&sortColumn=${encodeURIComponent(currentSortColumn)}&sortOrder=${encodeURIComponent(currentSortOrder)}`;
    }

    fetch(url)
        .then(response => response.text())
        .then(data => {
            document.getElementById('reportContainer').innerHTML = data;
            addSortListeners();
        })
        .catch(error => console.error('Error loading report:', error));
}

function loadNewReport(report){
    currentSortColumn = '';
    currentSortOrder = 'ASC';
    loadContent(report)
}

function searchReports() {
    if (typeof(reportType) !== 'undefined')
        loadContent(reportType);
}

function addSortListeners() {
    document.querySelectorAll('.sort').forEach(header => {
        header.addEventListener('click', function() {
            let column = this.getAttribute('data-column');
            if (currentSortColumn === column) {
                currentSortOrder = currentSortOrder === 'ASC' ? 'DESC' : 'ASC';
            } else {
                currentSortColumn = column;
                currentSortOrder = 'ASC';
            }
            searchReports();
        });
    });
}
