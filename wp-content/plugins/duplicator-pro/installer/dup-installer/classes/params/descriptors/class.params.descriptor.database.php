<?php
/**
 * Installer params manager
 *
 * Standard: PSR-2
 * @link http://www.php-fig.org/psr/psr-2 Full Documentation
 *
 * @final class DUPX_Paramas_Descriptor_urls_paths
  {
  package SC\DUPX\U
 *
 */
defined('ABSPATH') || defined('DUPXABSPATH') || exit;

/**
 * class where all parameters are initialized. Used by the param manager
 */
final class DUPX_Paramas_Descriptor_database implements DUPX_Interface_Paramas_Descriptor
{

    const INVALID_EMPTY           = 'can\'t be empty';
    const EMPTY_COLLATION_LABEL   = ' --- DEFAULT --- ';
    const DEFAULT_CHARSET_POSTFIX = ' [DEFAULT]';
    const DEFAULT_COLLATE_POSTFIX = ' [DEFAULT]';

    /**
     *
     * @param DUPX_Param_item[] $params
     */
    public static function init(&$params)
    {
        $archiveConfig = DUPX_ArchiveConfig::getInstance();

        $params[DUPX_Paramas_Manager::PARAM_DB_DISPLAY_OVERWIRE_WARNING] = new DUPX_Param_item(
            DUPX_Paramas_Manager::PARAM_DB_DISPLAY_OVERWIRE_WARNING,
            DUPX_Param_item::TYPE_BOOL,
            array(
            'default' => true
            )
        );

        $params[DUPX_Paramas_Manager::PARAM_DB_VIEW_MODE] = new DUPX_Param_item_form(
            DUPX_Paramas_Manager::PARAM_DB_VIEW_MODE,
            DUPX_Param_item_form::TYPE_STRING,
            DUPX_Param_item_form::FORM_TYPE_BGROUP,
            array(
            'default'      => 'basic',
            'acceptValues' => array(
                'basic',
                'cpnl'
            )
            ),
            array(
            'label'                 => '',
            'options'               => array(
                new DUPX_Param_item_form_option('basic', 'Default'),
                new DUPX_Param_item_form_option('cpnl', 'CPanel')
            ),
            'wrapperClasses'        => array('revalidate-on-change', 'align-right'),
            'inputContainerClasses' => array('small')
            )
        );

        $params[DUPX_Paramas_Manager::PARAM_DB_HOST] = new DUPX_Param_item_form(
            DUPX_Paramas_Manager::PARAM_DB_HOST,
            DUPX_Param_item_form::TYPE_STRING,
            DUPX_Param_item_form::FORM_TYPE_TEXT,
            array(
            'persistence'      => true,
            'default'          => 'localhost',
            'sanitizeCallback' => array('DupProSnapLibUtil', 'sanitize_non_stamp_chars_and_newline'),
            'validateCallback' => array(__CLASS__, 'validateNoEmptyIfBasic'),
            'invalidMessage'   => self::INVALID_EMPTY
            ),
            array(
            'label'          => 'Host:',
            'wrapperClasses' => array('revalidate-on-change'),
            'attr'           => array(
                'required'    => 'required',
                'placeholder' => 'localhost'
            )
            )
        );

        $params[DUPX_Paramas_Manager::PARAM_DB_NAME] = new DUPX_Param_item_form(
            DUPX_Paramas_Manager::PARAM_DB_NAME,
            DUPX_Param_item_form::TYPE_STRING,
            DUPX_Param_item_form::FORM_TYPE_TEXT,
            array(
            'persistence'      => true,
            'default'          => '',
            'sanitizeCallback' => array('DupProSnapLibUtil', 'sanitize_non_stamp_chars_and_newline'),
            'validateCallback' => array(__CLASS__, 'validateNoEmptyIfBasic'),
            'invalidMessage'   => self::INVALID_EMPTY
            ),
            array(
            'label'          => 'Database:',
            'wrapperClasses' => array('revalidate-on-change'),
            'attr'           => array(
                'required'    => 'required',
                'placeholder' => 'new or existing database name'
            ),
            'subNote'        => dupxTplRender('parts/params/db-name-notes', array(), false)
            )
        );

        $params[DUPX_Paramas_Manager::PARAM_DB_USER] = new DUPX_Param_item_form(
            DUPX_Paramas_Manager::PARAM_DB_USER,
            DUPX_Param_item_form::TYPE_STRING,
            DUPX_Param_item_form::FORM_TYPE_TEXT,
            array(
            'persistence'      => true,
            'default'          => '',
            'sanitizeCallback' => array('DupProSnapLibUtil', 'sanitize_non_stamp_chars_and_newline'),
            'validateCallback' => array(__CLASS__, 'validateNoEmptyIfBasic'),
            'invalidMessage'   => self::INVALID_EMPTY
            ),
            array(
            'label'          => 'User:',
            'wrapperClasses' => array('revalidate-on-change'),
            'attr'           => array(
                'placeholder'  => 'valid database username',
                // Can be written field wise
                // Ref. https://developer.mozilla.org/en-US/docs/Web/Security/Securing_your_site/Turning_off_form_autocompletion
                'autocomplete' => "off"
            )
            )
        );

        $params[DUPX_Paramas_Manager::PARAM_DB_PASS] = new DUPX_Param_item_form_pass(
            DUPX_Paramas_Manager::PARAM_DB_PASS,
            DUPX_Param_item_form_pass::TYPE_STRING,
            DUPX_Param_item_form_pass::FORM_TYPE_PWD_TOGGLE,
            array(
            'persistence'      => true,
            'default'          => '',
            'sanitizeCallback' => array('DupProSnapLibUtil', 'sanitize_non_stamp_chars_and_newline')
            ),
            array(
            'label'          => 'Password:',
            'wrapperClasses' => array('revalidate-on-change'),
            'attr'           => array(
                'placeholder'  => 'valid database user password',
                // Can be written field wise
                // Ref. https://devBasicBasiceloper.mozilla.org/en-US/docs/Web/Security/Securing_your_site/Turning_off_form_autocompletion
                'autocomplete' => "off"
            )
            )
        );

        $params[DUPX_Paramas_Manager::PARAM_DB_CHARSET] = new DUPX_Param_item_form(
            DUPX_Paramas_Manager::PARAM_DB_CHARSET,
            DUPX_Param_item_form::TYPE_STRING,
            DUPX_Param_item_form::FORM_TYPE_SELECT,
            array(
            'default'          => $archiveConfig->getWpConfigDefineValue('DB_CHARSET', ''),
            'sanitizeCallback' => array('DupProSnapLibUtil', 'sanitize_non_stamp_chars_newline_and_trim'),
            'validateRegex'    => DUPX_Param_item_form::VALIDATE_REGEX_AZ_NUMBER_SEP_EMPTY
            ),
            array(
            'label'  => 'Charset:',
            'status' => function () {
                if (DUPX_Paramas_Manager::getInstance()->getValue(DUPX_Paramas_Manager::PARAM_RESTORE_BACKUP_MODE)) {
                    return DUPX_Param_item_form::STATUS_DISABLED;
                } else {
                    return DUPX_Param_item_form::STATUS_ENABLED;
                }
            },
            'options' => array(__CLASS__, 'getCharsetSelectOptions')
            )
        );

        $params[DUPX_Paramas_Manager::PARAM_DB_COLLATE] = new DUPX_Param_item_form(
            DUPX_Paramas_Manager::PARAM_DB_COLLATE,
            DUPX_Param_item_form::TYPE_STRING,
            DUPX_Param_item_form::FORM_TYPE_SELECT,
            array(
            'default'          => $archiveConfig->getWpConfigDefineValue('DB_COLLATE', ''),
            'sanitizeCallback' => array('DupProSnapLibUtil', 'sanitize_non_stamp_chars_newline_and_trim'),
            'validateRegex'    => DUPX_Param_item_form::VALIDATE_REGEX_AZ_NUMBER_SEP_EMPTY
            ),
            array(
            'label'  => 'Collation:',
            'status' => function () {
                if (DUPX_Paramas_Manager::getInstance()->getValue(DUPX_Paramas_Manager::PARAM_RESTORE_BACKUP_MODE)) {
                    return DUPX_Param_item_form::STATUS_DISABLED;
                } else {
                    return DUPX_Param_item_form::STATUS_ENABLED;
                }
            },
            'options' => array(__CLASS__, 'getCollationSelectOptions')
            )
        );

        $tablePrefixWarning = "Changing this setting alters the database table prefix by renaming all tables and references to them.\n"
            ."Change it only if you're sure you know what you're doing!";

        $params[DUPX_Paramas_Manager::PARAM_DB_TABLE_PREFIX] = new DUPX_Param_item_form(
            DUPX_Paramas_Manager::PARAM_DB_TABLE_PREFIX,
            DUPX_Param_item_form::TYPE_STRING,
            DUPX_Param_item_form::FORM_TYPE_TEXT,
            array(
            'default'          => DUPX_ArchiveConfig::getInstance()->wp_tableprefix,
            'sanitizeCallback' => array('DupProSnapLibUtil', 'sanitize_non_stamp_chars_newline_and_trim'),
            'validateRegex'    => DUPX_Param_item_form::VALIDATE_REGEX_AZ_NUMBER_SEP
            ),
            array(
            'status' => function () {
                $archiveConfig = DUPX_ArchiveConfig::getInstance();
                if ($archiveConfig->getLicenseType() < DUPX_LicenseType::Freelancer) {
                    DUPX_Param_item_form::STATUS_INFO_ONLY;
                }

                if (DUPX_Paramas_Manager::getInstance()->getValue(DUPX_Paramas_Manager::PARAM_RESTORE_BACKUP_MODE)) {
                    return DUPX_Param_item_form::STATUS_DISABLED;
                } else {
                    return DUPX_Param_item_form::STATUS_READONLY;
                }
            },
            'label'            => 'Table Prefix:',
            'wrapperClasses'   => array('revalidate-on-change'),
            'postfixElement'   => 'button',
            'postfixElemLabel' => 'edit',
            'postfixBtnAction' => 'DUPX.editActivate(this, '.DupProSnapJsonU::wp_json_encode($tablePrefixWarning).');',
            'subNote'          => $archiveConfig->getLicenseType() >= DUPX_LicenseType::Freelancer ? '' : 'Changing the prefix is only available with Freelancer, Business or Gold licenses'
            )
        );

        $params[DUPX_Paramas_Manager::PARAM_DB_SPACING] = new DUPX_Param_item_form(
            DUPX_Paramas_Manager::PARAM_DB_SPACING,
            DUPX_Param_item_form::TYPE_BOOL,
            DUPX_Param_item_form::FORM_TYPE_CHECKBOX,
            array(
            'default' => false
            ),
            array(
            'label'         => 'Spacing:',
            'checkboxLabel' => 'Enable non-breaking space characters fix.'
            )
        );

        $params[DUPX_Paramas_Manager::PARAM_DB_VIEW_CREATION] = new DUPX_Param_item_form(
            DUPX_Paramas_Manager::PARAM_DB_VIEW_CREATION,
            DUPX_Param_item_form::TYPE_BOOL,
            DUPX_Param_item_form::FORM_TYPE_CHECKBOX,
            array(
            'default' => true
            ),
            array(
            'label'         => 'Views:',
            'checkboxLabel' => 'Enable View Creation.'
            )
        );

        $params[DUPX_Paramas_Manager::PARAM_DB_PROC_CREATION] = new DUPX_Param_item_form(
            DUPX_Paramas_Manager::PARAM_DB_PROC_CREATION,
            DUPX_Param_item_form::TYPE_BOOL,
            DUPX_Param_item_form::FORM_TYPE_CHECKBOX,
            array(
            'default' => true
            ),
            array(
            'label'         => 'Stored Procedures:',
            'checkboxLabel' => 'Enable Stored Procedure Creation.'
            )
        );

        $params[DUPX_Paramas_Manager::PARAM_DB_SPLIT_CREATES] = new DUPX_Param_item_form(
            DUPX_Paramas_Manager::PARAM_DB_SPLIT_CREATES,
            DUPX_Param_item_form::TYPE_BOOL,
            DUPX_Param_item_form::FORM_TYPE_CHECKBOX,
            array(
            'default' => true
            ),
            array(
            'label'         => 'Split Creates:',
            'checkboxLabel' => 'Run all CREATE queries at once.'
            )
        );

        $params[DUPX_Paramas_Manager::PARAM_DB_MYSQL_MODE_OPTS] = new DUPX_Param_item_form(
            DUPX_Paramas_Manager::PARAM_DB_MYSQL_MODE_OPTS,
            DUPX_Param_item_form::TYPE_STRING,
            DUPX_Param_item_form::FORM_TYPE_TEXT,
            array(
            'default'          => '',
            'validateRegex'    => '/^[A-Za-z0-9_\-,]*$/', // db options with , and can be empty
            'sanitizeCallback' => function ($value) {
                $value = DupProSnapLibUtil::sanitize_non_stamp_chars_newline_and_trim($value);
                return str_replace(' ', '', $value);
            },
            ),
            array(
            'label'          => ' ', // for aligment at PARAM_DB_MYSQL_MODE
            'wrapperClasses' => 'no-display',
            'subNote'        => 'Separate additional '.DUPX_View_Funcs::helpLink('step2', 'sql modes', false).' with commas &amp; no spaces.<br>'
            .'Example: <i>NO_ENGINE_SUBSTITUTION,NO_ZERO_IN_DATE,...</i>.</small>'
            )
        );

        $params[DUPX_Paramas_Manager::PARAM_DB_MYSQL_MODE] = new DUPX_Param_item_form(
            DUPX_Paramas_Manager::PARAM_DB_MYSQL_MODE,
            DUPX_Param_item_form::TYPE_STRING,
            DUPX_Param_item_form::FORM_TYPE_RADIO,
            array(
            'default'      => 'DEFAULT',
            'acceptValues' => array(
                'DEFAULT',
                'DISABLE',
                'CUSTOM'
            )
            ),
            array(
            'label'   => 'Mysql Mode:',
            'options' => array(
                new DUPX_Param_item_form_option('DEFAULT', 'Default', DUPX_Param_item_form_option::OPT_ENABLED, array(
                    'onchange' => "if ($(this).is(':checked')) { "
                    ."jQuery('#".$params[DUPX_Paramas_Manager::PARAM_DB_MYSQL_MODE_OPTS]->getFormWrapperId()."').addClass('no-display');"
                    ."}"
                    )),
                new DUPX_Param_item_form_option('DISABLE', 'Disable', DUPX_Param_item_form_option::OPT_ENABLED, array(
                    'onchange' => "if ($(this).is(':checked')) { "
                    ."jQuery('#".$params[DUPX_Paramas_Manager::PARAM_DB_MYSQL_MODE_OPTS]->getFormWrapperId()."').addClass('no-display');"
                    ."}"
                    )),
                new DUPX_Param_item_form_option('CUSTOM', 'Custom', DUPX_Param_item_form_option::OPT_ENABLED, array(
                    'onchange' => "if ($(this).is(':checked')) { "
                    ."jQuery('#".$params[DUPX_Paramas_Manager::PARAM_DB_MYSQL_MODE_OPTS]->getFormWrapperId()."').removeClass('no-display');"
                    ."}")),
            ))
        );

        $params[DUPX_Paramas_Manager::PARAM_DB_TABLES] = new DUPX_Param_item_form(
            DUPX_Paramas_Manager::PARAM_DB_TABLES,
            DUPX_Param_item_form::TYPE_ARRAY_STRING,
            DUPX_Param_item_form::FORM_TYPE_SELECT,
            array(// ITEM ATTRIBUTES
            'default'          => self::getTableList(),
            'sanitizeCallback' => array('DupProSnapLibUtil', 'sanitize_non_stamp_chars_newline_and_trim'),
            ), array(// FORM ATTRIBUTES
            'multiple' => true,
            'size'     => 10,
            'options'  => function ($paramObj) {
                $result        = array();
                $paramsManager = DUPX_Paramas_Manager::getInstance();
                $subsiteId     = $paramsManager->getValue(DUPX_Paramas_Manager::PARAM_SUBSITE_ID);
                $newPrefix     = $paramsManager->getValue(DUPX_Paramas_Manager::PARAM_DB_TABLE_PREFIX);

                foreach (DUPX_Paramas_Descriptor_database::getLabelTablesList($newPrefix, $subsiteId) as $label => $tableName) {
                    $result[] = new DUPX_Param_item_form_option($tableName, $label);
                }
                return $result;
            }
            )
        );
    }

    public static function validateNoEmptyIfBasic($value)
    {
        if (DUPX_Paramas_Manager::getInstance()->getValue(DUPX_Paramas_Manager::PARAM_DB_VIEW_MODE) === 'basic') {
            return DUPX_Paramas_Descriptors::validateNotEmpty($value);
        } else {
            $value = '';
            return true;
        }
    }

    /**
     * 
     * @return \DUPX_Param_item_form_option[]
     */
    public static function getCharsetSelectOptions()
    {
        if (DUPX_Paramas_Manager::getInstance()->getValue(DUPX_Paramas_Manager::PARAM_VALIDATION_LEVEL) < DUPX_Validation_manager::MIN_LEVEL_VALID) {
            return array();
        }

        $data       = DUPX_DB_Functions::getInstance()->getCharsetAndCollationData();
        $charsetDef = DUPX_DB_Functions::getInstance()->getDefaultCharset();

        $options = array();

        foreach ($data as $charset => $charsetInfo) {
            $label     = $charset.($charset == $charsetDef ? self::DEFAULT_CHARSET_POSTFIX : '');
            $options[] = new DUPX_Param_item_form_option($charset, $label, DUPX_Param_item_form_option::OPT_ENABLED, array(
                'data-collations'        => json_encode($charsetInfo['collations']),
                'data-collation-default' => $charsetInfo['defCollation']
            ));
        }

        return $options;
    }

    /**
     * 
     * @return \DUPX_Param_item_form_option[]
     */
    public static function getCollationSelectOptions()
    {
        $options = array(
            new DUPX_Param_item_form_option('', self::EMPTY_COLLATION_LABEL)
        );

        if (DUPX_Paramas_Manager::getInstance()->getValue(DUPX_Paramas_Manager::PARAM_VALIDATION_LEVEL) < DUPX_Validation_manager::MIN_LEVEL_VALID) {
            return $options;
        }

        $data           = DUPX_DB_Functions::getInstance()->getCharsetAndCollationData();
        $currentCharset = DUPX_Paramas_Manager::getInstance()->getValue(DUPX_Paramas_Manager::PARAM_DB_CHARSET);

        if (!isset($data[$currentCharset])) {
            return $options;
        }

        $defaultCollation = DUPX_DB_Functions::getInstance()->getDefaultCollateOfCharset($currentCharset);
        // if charset exists update default
        $options          = array(
            new DUPX_Param_item_form_option('', self::EMPTY_COLLATION_LABEL.' ['.$defaultCollation.']')
        );

        foreach ($data[$currentCharset]['collations'] as $collation) {
            $label     = $collation.($collation == $data[$currentCharset]['defCollation'] ? self::DEFAULT_COLLATE_POSTFIX : '');
            $options[] = new DUPX_Param_item_form_option($collation, $label);
        }

        return $options;
    }

    public static function getLabelTablesList($newPrefix = null, $subsiteId = false)
    {
        $sharedTables  = array();
        $subSiteTables = array();
        $finalTables   = array();

        $archive_config = DUPX_ArchiveConfig::getInstance();
        $oldPrefix      = $archive_config->wp_tableprefix;
        $tablePrefix    = is_null($newPrefix) ? $oldPrefix : $newPrefix;
        $tables         = (array) $archive_config->dbInfo->tablesList;
        $installType    = ($subsiteId !== false && $subsiteId > 0) ? 1 : 0;

        // there is only one `users` and `usermeta` table in multisite installation
        $generalTables = array(
            $tablePrefix.'commentmeta',
            $tablePrefix.'comments',
            $tablePrefix.'links',
            $tablePrefix.'options',
            $tablePrefix.'postmeta',
            $tablePrefix.'posts',
            $tablePrefix.'term_relationships',
            $tablePrefix.'term_taxonomy',
            $tablePrefix.'terms',
            $tablePrefix.'termmeta'
        );

        $multisiteOnlyTables = array(
            $tablePrefix.'blogmeta',
            $tablePrefix.'blogs',
            $tablePrefix.'blog_versions',
            $tablePrefix.'registration_log',
            $tablePrefix.'signups',
            $tablePrefix.'site',
            $tablePrefix.'sitemeta'
        );

        $allTableLabels = array();
        foreach ($tables as $table => $tableInfo) {
            if ($oldPrefix == $tablePrefix || (strpos($table, $oldPrefix) !== 0)) {
                $tableNew = $table;
            } else {
                $tableNew = $tablePrefix.substr($table, strlen($oldPrefix));
            }

            $numRows       = number_format($tableInfo->insertedRows === false ? $tableInfo->inaccurateRows : $tableInfo->insertedRows);
            $tableNewLabel = $tableNew.' [Rows '.$numRows.']';
            $allTableLabels[$tableNewLabel] = $tableNew;
        }

        /**
         * $pattern_shared_tables: match tables starting with $tablePrefix and not followed
         * by a number following a `_` character e.g. `wp_users`, `wp_duplicator_pro_entities`
         * $pattern_subsite_tables: match tables starting with $subsiteTablePrefix
         * and what the one above does e.g. `wp_3_posts`, `wp_3_comments`, `wp_users` tables
         */
        $subsiteTablePrefix     = "{$tablePrefix}{$subsiteId}_";
        $qTablePrefix           = preg_quote($tablePrefix, "/");
        $qSubsiteTablePrefix    = preg_quote($subsiteTablePrefix, "/");
        $pattern_shared_tables  = "^{$qTablePrefix}(?!\d+_)";
        $pattern_subsite_tables = "^{$qSubsiteTablePrefix}(.+)";

        foreach ($allTableLabels as $label => $tableNew) {
            //rename subsite tables before adding options if it's a standalone installation
            if ($installType === 1) {

                //Keep shared tables
                if (!in_array($tableNew, $generalTables) && preg_match("/{$pattern_shared_tables}/", $tableNew) && !in_array($tableNew,$multisiteOnlyTables)) {
                    continue;
                }

                //Keep only main site tables
                if ($subsiteId === 1 && in_array($tableNew, $generalTables)) {
                    continue;
                }

                //Keep only current subsite tables
                if ($subsiteId !== 1 && preg_match("/{$pattern_subsite_tables}/", $tableNew)) {
                    //get tables unique to the given sub-site
                    $newTableName = preg_replace("/^{$qSubsiteTablePrefix}/", $tablePrefix, $tableNew);
                    if (($key = array_search($newTableName, $allTableLabels)) !== false) {
                        unset($allTableLabels[$key]);
                    }
                    $allTableLabels[$label] = $newTableName;
                    continue;
                }

                unset($allTableLabels[$label]);
            }
        }

        return $allTableLabels;
    }

    public static function getTableList($newPrefix = null, $subsiteId = false)
    {
        $result = array();
        foreach (self::getLabelTablesList($newPrefix, $subsiteId) as $tableName) {
            $result[] = $tableName;
        }
        return $result;
    }

    public static function updateCharsetAndCollateByDatabaseSettings()
    {
        $paramsManager = DUPX_Paramas_Manager::getInstance();
        $data          = DUPX_DB_Functions::getInstance()->getCharsetAndCollationData();
        $charsetDef    = DUPX_DB_Functions::getInstance()->getDefaultCharset();

        $currentCharset = $paramsManager->getValue(DUPX_Paramas_Manager::PARAM_DB_CHARSET);
        $currentCollate = $paramsManager->getValue(DUPX_Paramas_Manager::PARAM_DB_COLLATE);

        if (!array_key_exists($currentCharset, $data)) {
            $paramsManager->setValue(DUPX_Paramas_Manager::PARAM_DB_CHARSET, $charsetDef);
            $paramsManager->setValue(DUPX_Paramas_Manager::PARAM_DB_COLLATE, '');
            DUPX_Log::info('DEFAULT DB_CHARSET ['.$currentCharset.'] isn\'t valid, update DB_CHARSET to '.$charsetDef.' and DB_COLLATE set empty');
        } else if (strlen($currentCollate) > 0 && !in_array($currentCollate, $data[$currentCharset]['collations'])) {
            $paramsManager->setValue(DUPX_Paramas_Manager::PARAM_DB_COLLATE, '');
            DUPX_Log::info('DEFAULT DB_COLLATE ['.$currentCollate.'] isn\'t valid, DB_COLLATE set empty');
        }
        $paramsManager->save();
    }

    /**
     * 
     * @param DUPX_Param_item[] $params
     */
    public static function updateParamsAfterOverwrite(&$params)
    {
        
    }
}