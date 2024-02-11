<?php
defined("ABSPATH") or die("");

/**
 * Used to display notices in the WordPress Admin area
 * This class takes advantage of the 'admin_notice' action.
 *
 * Standard: PSR-2
 * @link http://www.php-fig.org/psr/psr-2
 *
 * @package DUP_PRO
 * @subpackage classes/ui
 * @copyright (c) 2017, Snapcreek LLC
 * @license	https://opensource.org/licenses/GPL-3.0 GNU Public License
 *
 */
class DUP_PRO_UI_Notice
{

	const OPTION_KEY_INSTALLER_HASH_NOTICE			 = 'duplicator_pro_inst_hash_notice';
	const OPTION_KEY_ACTIVATE_PLUGINS_AFTER_INSTALL	 = 'duplicator_pro_activate_plugins_after_installation';

	const GEN_INFO_NOTICE    = 0;
    const GEN_SUCCESS_NOTICE = 1;
    const GEN_WARNING_NOTICE = 2;
	const GEN_ERROR_NOTICE   = 3;

	/**
	 * init notice actions
	 */
	public static function init()
	{
		$methods = array(
			'showReservedFilesNotice',
			'newInstallerHashOption',
			'showNoExportCapabilityNotice'
		);
		$action	 = is_multisite() ? 'network_admin_notices' : 'admin_notices';
		foreach ($methods as $method) {
			add_action($action, array('DUP_PRO_UI_Notice', $method));
		}
	}

	public static function newInstallerHashOption()
	{
		if (get_option(self::OPTION_KEY_INSTALLER_HASH_NOTICE) != true) {
			return;
		}

		$screen = get_current_screen();
		if (!in_array($screen->parent_base, array('plugins', 'duplicator-pro'))) {
			return;
		}

		$action			 = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
		$installerMode	 = filter_input(INPUT_POST, 'installer_name_mode', FILTER_SANITIZE_STRING);
		if ($screen->id == 'duplicator-pro_page_duplicator-pro-settings' && $action == 'save' && $installerMode == DUP_PRO_Global_Entity::INSTALLER_NAME_MODE_WITH_HASH) {
			delete_option(self::OPTION_KEY_INSTALLER_HASH_NOTICE);
			return;
		}

		if (DUP_PRO_Global_Entity::get_instance()->installer_name_mode == DUP_PRO_Global_Entity::INSTALLER_NAME_MODE_WITH_HASH) {
			delete_option(self::OPTION_KEY_INSTALLER_HASH_NOTICE);
			return;
		}
		?>
		<div class="dup-notice-success notice notice-success duplicator-pro-admin-notice is-dismissible" data-to-dismiss="<?php echo esc_attr(self::OPTION_KEY_INSTALLER_HASH_NOTICE); ?>" >
			<p>
				<?php DUP_PRO_U::esc_html_e('Duplicator PRO now includes a new option that helps secure the installer.php file.'); ?><br>
				<?php DUP_PRO_U::esc_html_e('After this option is enabled, a security hash will be added to the name of the installer when it\'s downloaded.'); ?>
			</p>
			<p>
				<?php
				echo sprintf(
					DUP_PRO_U::__('To enable this option or to get more information, open the <a href="%s">Package Settings</a> and visit the Installer section.'),
					'admin.php?page=duplicator-pro-settings&tab=package#duplicator-pro-installer-settings');
				?>
			</p>
		</div>
		<?php
	}

	/**
	 * Shows a display message in the wp-admin if any reserved files are found
	 *
	 * @return void
	 */
	public static function showReservedFilesNotice()
	{
		echo "<style>div.notice-safemode{color:maroon;}</style>";
		$dpro_active = is_plugin_active('duplicator-pro/duplicator-pro.php');
		$dup_perm	 = current_user_can('manage_options');
		if (!$dpro_active || !$dup_perm) {
			return;
		}

		//Hide free error message if Pro is active
		if (is_plugin_active('duplicator/duplicator.php')) {
			echo "<style>div#dup-global-error-reserved-files {display:none}</style>";
		}

		$screen = get_current_screen();
		if (!isset($screen)) {
			return;
		}

		$on_active_tab					 = isset($_GET['section']) ? $_GET['section'] : '';
		$is_lite_installer_cleanup_req	 = ($screen->id == 'duplicator_page_duplicator-tools' && isset($_GET['action']) && $_GET['action'] == 'installer');
		$onDiagnosticsCreanupPage		 = (DUP_PRO_CTRL_Tools::isToolPage() && ($on_active_tab == "diagnostic" || $on_active_tab == ''));
		$wrapperClass					 = ($onDiagnosticsCreanupPage) ? 'diagnostic-site-page' : 'general-site-page';
		$actionId						 = 'dpro-notice-action-'.$wrapperClass;

		if (DUP_PRO_Server::hasInstallFiles() && !$is_lite_installer_cleanup_req) {


			echo '<div class="dup-updated notice-success '.$wrapperClass.'" id="dpro-global-error-reserved-files" ><p>';

			//Safe Mode Notice
			$safe_html = '';
			if (get_option("duplicator_pro_exe_safe_mode", 0) > 0) {
				$safe_msg1	 = DUP_PRO_U::__('Safe Mode:');
				$safe_msg2	 = DUP_PRO_U::__('During the install safe mode was enabled deactivating all plugins.<br/> Please be sure to ');
				$safe_msg3	 = DUP_PRO_U::__('re-activate the plugins');
				$safe_html	 = "<div class='notice-safemode'><b>{$safe_msg1}</b><br/>{$safe_msg2} <a href='plugins.php'>{$safe_msg3}</a>!</div><br/>";
			}

			//On Diagnostics > Cleanup Page
			if ($onDiagnosticsCreanupPage) {

				$title		 = DUP_PRO_U::__('This site has been successfully migrated!');
				$msg1		 = DUP_PRO_U::__('Final step:');
				$msg2		 = DUP_PRO_U::__('This message will be removed after all installer files are removed.  Installer files must be removed to maintain a secure site. '
                                .'Click the link above to remove all installer files and complete the migration.');
                $msg3		 = DUP_PRO_U::__('If an archive.zip/daf file was intentially added to the root directory to perform an overwrite install of this site then you can ignore this message.');
				$linkLabel	 = DUP_PRO_U::esc_html__('Remove Installation Files Now!');

				echo "<b class='pass-msg'><i class='fa fa-check-circle'></i> {$title}</b> <br/> {$safe_html} <b>".esc_html($msg1)."</b> <br/>";
				echo "<a id=\"".$actionId."\" href='javascript:void(0)' onclick='jQuery(\"#dpro-remove-installer-files-btn\").click()'>".$linkLabel."</a><br/>";
				echo "<div class='pass-msg'>" . esc_html($msg2) . "<br/><i class='fas fa-info-circle'></i> " .  esc_html($msg3) . "</div>";

				//All other Pages
			} else {

				$title	 = DUP_PRO_U::__('Migration Almost Complete!');
				$msg	 = DUP_PRO_U::esc_html__('Reserved Duplicator Pro installation files have been detected in the root directory.  Please delete these installation files to '
						.'avoid security issues.').' <br/> '.DUP_PRO_U::esc_html__('Go to: Tools > Diagnostics > Stored Data > and click the "Remove Installation Files" button');
                $msg2	= DUP_PRO_U::__('If an archive.zip/daf file was intentially added to the root directory to perform an overwrite install of this site then you can ignore this message.');

				$nonce		 = wp_create_nonce('duplicator_pro_cleanup_page');
				$url		 = self_admin_url('admin.php?page=duplicator-pro-tools&tab=diagnostics&_wpnonce='.$nonce);
				$linkLabel	 = DUP_PRO_U::esc_html__('Take me there now!');

				echo "<b>".esc_html($title)."</b><br/> {$safe_html} {$msg}<br/>";
                echo "<a id=\"".$actionId."\" href='".$url."'>".$linkLabel."</a><br/>";
                echo "<small><i>Note: " .  esc_html($msg2) . "</i></small><br/><br/>" ;

			}
			echo "</p></div>";
		}
	}

	/**
	 * Shows a display message in the wp-admin if the logged in user role has not export capability
	 *
	 * @return void
	 */
	public static function showNoExportCapabilityNotice() {
		if (is_admin() && in_array('administrator', $GLOBALS['current_user']->roles) && !current_user_can('export')) {
			$errorMessage = DUP_PRO_U::__('<strong>Duplicator Pro</strong><hr> Your logged-in user role does not have export capability so you don\'t have access to Duplicator Pro functionality.').
								"<br>".
								sprintf(DUP_PRO_U::__('<strong>RECOMMENDATION:</strong> Add export capability to your role. See FAQ: <a target="_blank" href="%s">%s</a>'), 'https://snapcreek.com/duplicator/docs/faqs-tech/#faq-licensing-040-q', DUP_PRO_U::__('Why is the Duplicator/Packages menu missing from my admin menu?'));
			DUP_PRO_UI_Notice::displayGeneralAdminNotice($errorMessage, DUP_PRO_UI_Notice::GEN_ERROR_NOTICE, true);
		}
	}

	/**
     * display genral admin notice by printing it
     *
     * @param string $htmlMsg html code to be printed
     * @param integer $noticeType constant value of SELF::GEN_
     * @param boolean $isDismissible whether the notice is dismissable or not. Default is true 
     * @param array|string $extraClasses add more classes to the notice div
     * @return void
     */
    public static function displayGeneralAdminNotice($htmlMsg, $noticeType, $isDismissible = true, $extraClasses = array()) {
        if (empty($extraClasses)) {
            $classes = array();
        } elseif (is_array($extraClasses)) {
            $classes = $extraClasses;
        } else {
            $classes = array($extraClasses);
        }

        $classes[] = 'notice';

        switch($noticeType) {
            case DUP_PRO_UI_Notice::GEN_INFO_NOTICE:
                $classes[] = 'notice-info';
                break;
            case DUP_PRO_UI_Notice::GEN_SUCCESS_NOTICE:
                $classes[] = 'notice-success';
                break;
            case DUP_PRO_UI_Notice::GEN_WARNING_NOTICE:
                $classes[] = 'notice-warning';
                break;
            case DUP_PRO_UI_Notice::GEN_ERROR_NOTICE:
                $classes[] = 'notice-error';
                break;
            default:
                throw new Exception('Invalid Admin notice type!');
        }

        if ($isDismissible) {
            $classes[] = 'is-dismissible';
        }

        $classesStr = implode(' ', $classes);
        ?>
        <div class="<?php echo esc_attr($classesStr);?>">
            <p>
                <?php
                if (DUP_PRO_UI_Notice::GEN_ERROR_NOTICE == $noticeType) {
                ?>
                <i class='fa fa-exclamation-triangle'></i>
                <?php
                }
                ?>
                <?php
                echo $htmlMsg;
                ?>
            </p>
        </div>
        <?php
    }
}