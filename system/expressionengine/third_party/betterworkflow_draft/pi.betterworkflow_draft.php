<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$plugin_info = array(
	'pi_name' => 'Better Workflow Draft',
	'pi_version' => '1.1',
	'pi_author' => 'Loren Klingman',
	'pi_author_url' => 'https://github.com/wiseloren/betterworkflow_draft',
	'pi_description' => 'Create notes that only show for better workflow drafts or only show on the live site.',
	'pi_usage' => '# Better Workflow Draft v1.1 #

Create notes that only show for better workflow drafts or only show on the live site.  This must be used inside the exp:channel:entries tag to work properly.

## Parameters

* draft 
	* preview  - _default_, will show only for any preview whether or not it is a draft (anytime "Save and Preview" is used the view).  If there are multiple channel entries rows returned, this will show in every row.
	* draft, on - will show only for a previewed draft (drafts are unpublished versions of live entries).  If there are multiple channel entries returned, this will only show in the row that is the draft.
	* live, off - will show only for views on the live website.  It will not show at all if "Save and Preview" was used to view the preview.
* parse
	* inward - will cause the tags inside to not be parsed if the test fails

## Examples
{exp:channel:entries}

{exp:betterworkflow_draft parse="inward"}You are viewing a betterworkflow preview.{/exp:betterworkflow_draft}

{exp:betterworkflow_draft parse="inward" draft="draft"}You are viewing a betterworkflow draft.{/exp:betterworkflow_draft}

{exp:betterworkflow_draft parse="inward" draft="live"}You are viewing on the website.{/exp:betterworkflow_draft}

{/exp:channel:entries}',
);

/**
 * Better Workflow Draft
 *
 * Create notes that only show for better workflow drafts or only show on the live site.
 *
 * @author Loren Klingman
 * @link https://github.com/wiseloren/betterworkflow_draft
 * @version 1.1
 *
 * @property CI_Controller $EE
 */
class Betterworkflow_draft
{
	/**
	 * @var string the plugin result
	 */
	public $return_data = '';

	/**
	 * constructor and plugin renderer
	 *
	 * @return string
	 */
	public function Betterworkflow_draft()
	{
		$this->EE =& get_instance();
		$draft = $this->EE->TMPL->fetch_param('draft');
		if (!$draft) {
			$draft = "preview";
		}
		switch ($draft) {
			case 'draft':
			case 'yes':
				if (!isset($this->EE->session->cache['ep_better_workflow']['is_draft']) 
					|| !$this->EE->session->cache['ep_better_workflow']['is_draft']) {
					$this->EE->TMPL->log_item('Better Workflow Draft: Skipping, this is not a better workflow draft.');
					return '';
				}
				break;
			case 'live':
			case 'no':
				if ((isset($this->EE->session->cache['ep_better_workflow']['is_valid_preview_request']) 
					&& $this->EE->session->cache['ep_better_workflow']['is_valid_preview_request']) || 
					(isset($this->EE->session->cache['ep_better_workflow']['is_draft']) 
					&& $this->EE->session->cache['ep_better_workflow']['is_draft'])) {
					$this->EE->TMPL->log_item('Better Workflow Draft: Skipping, this is a better workflow draft or preview.');
					return '';
				}
				break;
			default:
				if ((!isset($this->EE->session->cache['ep_better_workflow']['is_valid_preview_request']) 
					&& !$this->EE->session->cache['ep_better_workflow']['is_valid_preview_request'])) {
					$this->EE->TMPL->log_item('Better Workflow Draft: Skipping, this is not a better workflow preview.');
					return '';
				}
				break;
			break;
		}

		return $this->return_data = $this->EE->TMPL->tagdata;
	}
}

/* End of file pi.betterworkflow_draft.php */
/* Location: ./system/expressionengine/third_party/betterworkflow_draft/pi.betterworkflow_draft.php */