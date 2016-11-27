<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;

$this->layout = false;

$cakeDescription = 'A Demo task management site';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>
    </title>
    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('cake.css') ?>
</head>
<body class="home">
    <header>
        <div class="header-image">
            <h1>TrelloD: A Task Management Portal</h1>
			<h4>
			<a href="/users/login"> Existing Users</a><br/>
			<a href="/users/add"> New Users</a>
			</h4>
        </div>
    </header>
    <div id="content">
        <div class="row">
            <div class="columns large-12 checks">
			<h2> Background Server Checks</h2>
                <h4>Environment</h4>
                <?php if (version_compare(PHP_VERSION, '5.5.9', '>=')): ?>
                    <p class="success">Your version of PHP is 5.5.9 or higher (detected <?= PHP_VERSION ?>).</p>
                <?php else: ?>
                    <p class="problem">Your version of PHP is too low. You need PHP 5.5.9 or higher to use CakePHP (detected <?= PHP_VERSION ?>).</p>
                <?php endif; ?>

                <?php if (extension_loaded('mbstring')): ?>
                    <p class="success">Your version of PHP has the mbstring extension loaded.</p>
                <?php else: ?>
                    <p class="problem">Your version of PHP does NOT have the mbstring extension loaded.</p>;
                <?php endif; ?>

                <?php if (extension_loaded('openssl')): ?>
                    <p class="success">Your version of PHP has the openssl extension loaded.</p>
                <?php elseif (extension_loaded('mcrypt')): ?>
                    <p class="success">Your version of PHP has the mcrypt extension loaded.</p>
                <?php else: ?>
                    <p class="problem">Your version of PHP does NOT have the openssl or mcrypt extension loaded.</p>
                <?php endif; ?>

                <?php if (extension_loaded('intl')): ?>
                    <p class="success">Your version of PHP has the intl extension loaded.</p>
                <?php else: ?>
                    <p class="problem">Your version of PHP does NOT have the intl extension loaded.</p>
                <?php endif; ?>
                <hr>

                <h4>Filesystem</h4>
                <?php if (is_writable(TMP)): ?>
                    <p class="success">Your tmp directory is writable.</p>
                <?php else: ?>
                    <p class="problem">Your tmp directory is NOT writable.</p>
                <?php endif; ?>

                <?php if (is_writable(LOGS)): ?>
                    <p class="success">Your logs directory is writable.</p>
                <?php else: ?>
                    <p class="problem">Your logs directory is NOT writable.</p>
                <?php endif; ?>

                <?php $settings = Cache::config('_cake_core_'); ?>
                <?php if (!empty($settings)): ?>
                    <p class="success">The <em><?= $settings['className'] ?>Engine</em> is being used for core caching. To change the config edit config/app.php</p>
                <?php else: ?>
                    <p class="problem">Your cache is NOT working. Please check the settings in config/app.php</p>
                <?php endif; ?>

                <hr>
                <h4>Database</h4>
                <?php
                    try {
                        $connection = ConnectionManager::get('default');
                        $connected = $connection->connect();
                    } catch (Exception $connectionError) {
                        $connected = false;
                        $errorMsg = $connectionError->getMessage();
                        if (method_exists($connectionError, 'getAttributes')):
                            $attributes = $connectionError->getAttributes();
                            if (isset($errorMsg['message'])):
                                $errorMsg .= '<br />' . $attributes['message'];
                            endif;
                        endif;
                    }
                ?>
                <?php if ($connected): ?>
                    <p class="success">CakePHP is able to connect to the database.</p>
                <?php else: ?>
                    <p class="problem">CakePHP is NOT able to connect to the database.<br /><br /><?= $errorMsg ?></p>
                <?php endif; ?>

                <hr>
                <h4>DebugKit</h4>
                <?php if (Plugin::loaded('DebugKit')): ?>
                    <p class="success">DebugKit is loaded.</p>
                <?php else: ?>
                    <p class="problem">DebugKit is NOT loaded. You need to either install pdo_sqlite, or define the "debug_kit" connection name.</p>
                <?php endif; ?>
            </div>
        </div>

        <hr/>

        <div class="row">
            <div class="columns large-12">
                <h3 class="">More about this portal</h3>
                <p>
                    A demo task management portal devloped by saheed popoola.
                </p>
                <p>
                    This web app was built as part of the preliminary process for my application as a PHP developer.
                </p>
				<p>
                    This web app was developed using the <a href="http://cakephp.org">CakePHP</a> framework
                </p>

                
            </div>
        </div>
    </div>
</body>
</html>
