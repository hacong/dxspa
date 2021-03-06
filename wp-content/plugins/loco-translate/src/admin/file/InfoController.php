<?php
/**
 * File info / management view.
 */
class Loco_admin_file_InfoController extends Loco_admin_file_BaseController {


    /**
     * {@inheritdoc}
     */
    public function init(){
        parent::init();
        $this->enqueueStyle('fileinfo');
        //
        $file = $this->get('file');
        $bundle = $this->getBundle();
        $this->set('title', $file->basename().' &lsaquo; '.$bundle->getName() );
    }


    /**
     * {@inheritdoc}
     */
    public function getHelpTabs(){
        return array (
            __('Overview','default') => $this->view('tab-file-info'),
        );
    }
    
    
    /**
     * {@inheritdoc}
     */
    public function render(){
        
        $file = $this->get('file');

        $name = $file->basename();
        $this->set('title', $name );
        
        if( $fail = $this->getFileError($file) ){
            return $fail;
        }
        
        $ext = strtolower( $file->extension() );
        $path = $file->getPath();
        
        // file info
        $info = Loco_mvc_FileParams::create( $file );
        $this->set('file', $info );
        $info['type'] = strtoupper($ext);
        if( $file->exists() ){
            $info['existant'] = true;
            $info['writable'] = $file->writable();
            $info['deletable'] = $file->deletable();
            $info['mtime'] = $file->modified();
        }
        
        // location info
        $dir = new Loco_fs_LocaleDirectory( $file->dirname() );
        $info = Loco_mvc_FileParams::create( $dir );
        $this->set('dir', $info );
        $info['type'] = $dir->getTypeId();
        if( $dir->exists() && $dir->isDirectory() ){
            $info['existant'] = true;
            $info['writable'] = $dir->writable();
        }
        
        // get the name of the webserver for information purposes
        $this->set('httpd', Loco_compat_PosixExtension::getHttpdUser() );
        
        // unknown file template if required
        $locale = null;
        $tpl = 'admin/file/info-other';
        
        // we should know the project the file belongs to, but permitting orphans for debugging
        try {
            $project = $this->getProject();
            $template = $project->getPot();
            $isTemplate = $template && $file->equal($template);
            $this->set('isTemplate', $isTemplate );
        }
        catch( Loco_error_Exception $e ){
            $isTemplate = false;
            $template = null;
        }

        // file will be Gettext most likely            
        if( 'pot' === $ext || 'po' === $ext || 'mo' === $ext ){
            // treat as templte until locale verified
            $tpl = 'admin/file/info-pot';
            // don't attempt to pull locale of template file
            if( 'pot' !== $ext && ! $isTemplate ){
                $locale = $file->getLocale();
                $code = (string) $locale;
                if( $locale->isValid() ){
                    $api = new Loco_api_WordPressTranslations;
                    $locale->fetchName( $api );
                    $this->set( 'locale', new Loco_mvc_ViewParams( array(
                        'code' => $code,
                        'name' => $locale->getName(),
                        'icon' => $locale->getIcon(),
                        'lang' => $locale->lang,
                    ) ) );
                    // find PO/MO counter parts
                    if( 'po' === $ext ){
                        $tpl = 'admin/file/info-po';
                        $sibling = $file->cloneExtension('mo');
                    }
                    else {
                        $tpl = 'admin/file/info-mo';
                        $sibling = $file->cloneExtension('po');
                    }
                    $info = Loco_mvc_FileParams::create($sibling);
                    $this->set( 'sibling', $info );
                    if( $sibling->exists() ){
                        $info['existant'] = true;
                        $info['writable'] = $sibling->writable();
                    }
                }
            }
            // Do full parse to get stats and headers
            try {
                $data = Loco_gettext_Data::load($file);
                $head = $data->getHeaders();
                $author = $head->trimmed('Last-Translator') or $author = __('Unknown author','loco');
                $this->set( 'author', $author );
                // date headers may not be same as file modification time (files copied to server etc..)
                $podate = $head->trimmed( $locale ? 'PO-Revision-Date' : 'POT-Creation-Date' );
                $potime = Loco_gettext_Data::parseDate($podate) or $potime = $file->modified();
                $this->set('potime', $potime );
                // access to meta stats, normally cached on listing pages
                $meta = Loco_gettext_Metadata::create($file,$data);
                $this->set( 'meta', $meta );
                // allow PO header to specify alternative template for sync
                if( $head->has('X-Loco-Template') ){
                    $altpot = new Loco_fs_File($head['X-Loco-Template']);
                    $altpot->normalize( $this->getBundle()->getDirectoryPath() );
                    if( $altpot->exists() && ( ! $template || ! $template->equal($altpot) ) ){
                        $this->set('altpot', true );
                        $template = $altpot;
                    }
                }
                // missing or invalid headers are tollerated but developers should be notified
                if( ! count($head) ){
                    Loco_error_AdminNotices::debug(__('File does not have a valid header','loco'));
                }
                // establish whether PO is in sync with POT
                if( $template && ! $isTemplate && 'po' === $ext && $template->exists() ){
                    try {
                        $this->set('potfile', new Loco_mvc_FileParams( array(
                            'synced' => Loco_gettext_Data::load($template)->equalSource($data),
                        ), $template ) );
                    }
                    catch( Exception $e ){
                        // ignore invalid template in this context
                    }
                }
                // language sanity check. Developer warning if file name disagrees with PO header
                if( $locale && ( $value = $head['Language'] ) ){
                    $check = (string) Loco_Locale::parse($value);
                    if( $check !== $code ){
                        Loco_error_AdminNotices::debug( sprintf( __('Language header is "%s" but file name contains "%s"','loco'), $value, $code ) );
                    }
                }
            }
            catch( Exception $e ){
                $this->set('error', $e->getMessage() );
                $tpl = 'admin/file/info-other';
            }
        }

        return $this->view( $tpl );
    }
    
}
