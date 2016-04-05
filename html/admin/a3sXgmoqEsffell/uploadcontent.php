<?php
/**
*http://brandonsummers.name/blog/2012/02/10/using-bitbucket-for-automated-deployments/
*/
date_default_timezone_set("Asia/Tokyo");

class Deploy {

    /**
     * A callback function to call after the deploy has finished.
     * 
     * @var callback
     */
    public $post_deploy;

    /**
     * The name of the file that will be used for logging deployments. Set to 
     * FALSE to disable logging.
     * 
     * @var string
     */
    private $_log = 'deployments.log';

    /**
     * The timestamp format used for logging.
     * 
     * @link    http://www.php.net/manual/en/function.date.php
     * @var     string
     */
    private $_date_format = 'Y-m-d H:i:sP';

    /**
     * The name of the branch to pull from.
     * 
     * @var string
     */
    private $_branch = 'Branch_master_yhecq';

    /**
     * The name of the remote to pull from.
     * 
     * @var string
     */
    private $_remote = 'origin';

    /**
     * The directory where your website and git repository are located, can be 
     * a relative or absolute path
     * 
     * @var string
     */
    private $_directory;

    /**
     * Sets up defaults.
     * 
     * @param  string  $directory  Directory where your website is located
     * @param  array   $data       Information about the deployment
     */
    public function __construct($directory, $options = array())
    {
        // Determine the directory path
        $this->_directory = realpath($directory).DIRECTORY_SEPARATOR;

        $available_options = array('log', 'date_format', 'branch', 'remote');

        foreach ($options as $option => $value)
        {
            if (in_array($option, $available_options))
            {
                $this->{'_'.$option} = $value;
            }
        }

        $this->log('Attempting deployment...');
    }

    /**
     * Writes a message to the log file.
     * 
     * @param  string  $message  The message to write
     * @param  string  $type     The type of log message (e.g. INFO, DEBUG, ERROR, etc.)
     */
    public function log($message, $type = 'INFO')
    {
        if ($this->_log)
        {
            // Set the name of the log file
            $filename = $this->_log;

            if ( ! file_exists($filename))
            {
                // Create the log file
                file_put_contents($filename, '');

                // Allow anyone to write to log files
                chmod($filename, 0666);
            }

            // Write the message into the log file
            // Format: time --- type: message
            file_put_contents($filename, date($this->_date_format).' --- '.$type.': '.$message.PHP_EOL, FILE_APPEND);
        }
    }

    /**
     * Executes the necessary commands to deploy the website.
     */
    public function execute()
    {
        try
        {
            //exec('set $HOME=/home/ec2-user ', $output);
            // Make sure we're in the right directory
            exec('cd '.$this->_directory, $output);
            $this->log('Changing working directory... '.implode(' ', $output));

            //exec('git config  user.email "autodeploy@gmail.com"', $output);
            //exec('git config  user.name "autodeploy"', $output);
            // Discard any changes to tracked files since our last deploy
            exec('git add .', $output);
            $this->log('Reseting repository... '.implode(' ', $output));

            // Update the local repository
            exec("git commit -m 'update design content' ", $output);
            $this->log('committing in changes... '.implode(' ', $output));
            exec("git push ", $output);
            $this->log('push in changes... '.implode(' ', $output));


            $this->log('Deployment successful.');
        }
        catch (Exception $e)
        {
            $this->log($e, 'ERROR');
        }
    }

}


//echo'test';
//exit;


// This is just an example
$deploy = new Deploy('/home/ec2-user/yhecqdev/data/Smarty/templates');

/*
$deploy->post_deploy = function() use ($deploy) {
    // hit the wp-admin page to update any db changes
    exec('curl http://www.foobar.com/wp-admin/upgrade.php?step=upgrade_db');
    $deploy->log('Updating wordpress database... ');
};
*/

$deploy->execute();
echo "templates upload completed...";
// This is just an example
$deploy = new Deploy('/home/ec2-user/yhecqdev/html/user_data');

/*
$deploy->post_deploy = function() use ($deploy) {
    // hit the wp-admin page to update any db changes
    exec('curl http://www.foobar.com/wp-admin/upgrade.php?step=upgrade_db');
    $deploy->log('Updating wordpress database... ');
};
*/

$deploy->execute();
echo "css images upload completed...";
?>