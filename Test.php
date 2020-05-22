<?php
require('UserInfo.php');
?>

<!DOCTYPE html>
<html>

<head>
    <title>Export HTML Table Data to Excel using JavaScript | Tutorialswebsite</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script type="text/javascript">
        function exportToExcel(tableID, filename = '') {
            var downloadurl;
            var dataFileType = 'application/vnd.ms-excel';
            var tableSelect = document.getElementById(tableID);
            var tableHTMLData = tableSelect.outerHTML.replace(/ /g, '%20');

            // Specify file name
            filename = filename ? filename + '.xls' : 'export_excel_data.xls';

            // Create download link element
            downloadurl = document.createElement("a");

            document.body.appendChild(downloadurl);

            if (navigator.msSaveOrOpenBlob) {
                var blob = new Blob(['\ufeff', tableHTMLData], {
                    type: dataFileType
                });
                navigator.msSaveOrOpenBlob(blob, filename);
            } else {
                // Create a link to the file
                downloadurl.href = 'data:' + dataFileType + ', ' + tableHTMLData;

                // Setting the file name
                downloadurl.download = filename;

                //triggering the function
                downloadurl.click();
            }
        }
    </script>
</head>

<body>
    <div class="container">
        <table id="tblexportData" class="table">
            <thead class="thead-dark">
                <tr>
                    <th>Địa Chỉ IP</th>
                    <th>Thiết Bị</th>
                    <th>Hệ Điều Hành</th>
                    <th>Trình Duyệt</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?= UserInfo::get_ip(); ?></td>
                    <td><?= UserInfo::get_device(); ?></td>
                    <td><?= UserInfo::get_os(); ?></td>
                    <td><?= UserInfo::get_browser(); ?></td>
                </tr>
            </tbody>
        </table>

        <button onclick="exportToExcel('tblexportData', 'user-data')" class="btn btn-success">Xuất file</button>
    </div>
</body>

</html>