<?php
/**
 *
 * @package templates/default
 *
 */
defined('ABSPATH') || defined('DUPXABSPATH') || exit;

$paramsManager   = DUPX_Paramas_Manager::getInstance();
$nManager        = DUPX_NOTICE_MANAGER::getInstance();
$finalReportData = $paramsManager->getValue(DUPX_Paramas_Manager::PARAM_FINAL_REPORT_DATA);
?>
<div id="s4-install-report" style='display:none'>    
    <div id="s4-notice-reports" class="report-sections-list">
        <?php
        $nManager->displayFinalRepostSectionHtml('general', 'General notices report');
        $nManager->displayFinalRepostSectionHtml('files', 'Files notices report');
        $nManager->displayFinalRepostSectionHtml('database', 'Database notices report');
        $nManager->displayFinalRepostSectionHtml('search_replace', 'Search and replace notices report');
        $nManager->displayFinalRepostSectionHtml('plugins', 'Plugins actions report');
        ?>
    </div>

    <table class='s4-report-results' style="width:100%">
        <tr>
            <th colspan="4">Database Report</th>
        </tr>
        <tr style="font-weight:bold">
            <td style="width:150px"></td>
            <td>Tables</td>
            <td>Rows</td>
            <td>Cells</td>
        </tr>
        <tr>
            <td>Created</td>
            <td><span><?php echo $finalReportData['extraction']['table_count']; ?></span></td>
            <td><span><?php echo $finalReportData['extraction']['table_rows']; ?></span></td>
            <td>n/a</td>
        </tr>
        <tr>
            <td>Scanned</td>
            <td><span><?php echo $finalReportData['replace']['scan_tables']; ?></span></td>
            <td><span><?php echo $finalReportData['replace']['scan_rows']; ?></span></td>
            <td><span><?php echo $finalReportData['replace']['scan_cells']; ?></span></td>
        </tr>
        <tr>
            <td>Updated</td>
            <td><span><?php echo $finalReportData['replace']['updt_tables']; ?></span></td>
            <td><span><?php echo $finalReportData['replace']['updt_rows']; ?></span></td>
            <td><span><?php echo $finalReportData['replace']['updt_cells']; ?></span></td>
        </tr>
    </table>
</div>
