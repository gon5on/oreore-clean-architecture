<?php
namespace Cake\Composer\Installer;

use Composer\Installer\LibraryInstaller;
use Composer\Script\Event;

/**
 * @deprecated No longer needed since v1.3.
 *   It has been kept only to show warning to users to remove
 *   PluginInstaller::postAutoloadDump from the "post-autoload-dump" hook.
 */
class PluginInstaller extends LibraryInstaller
{
    /**
     * Warn the developer of action they need to take
     *
     * @param string $title Warning title
     * @param string $text warning text
     * @param \Composer\IO\IOInterface $io IOInterface object
     * @return void
     */
    public static function warnUser($title, $text, $io)
    {
        $wrap = function ($text, $width = 75) {
            return '<error>     ' . str_pad($text, $width) . '</error>';
        };

        $messages = [
            '',
            '',
            $wrap(''),
            $wrap($title),
            $wrap(''),
        ];

        $lines = explode("\n", wordwrap($text, 68));
        foreach ($lines as $line) {
            $messages[] = $wrap($line);
        }

        $messages = array_merge($messages, [$wrap(''), '', '']);

        $io->write($messages);
    }
}
