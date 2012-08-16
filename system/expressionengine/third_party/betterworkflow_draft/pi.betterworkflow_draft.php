<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$plugin_info = array(
	'pi_name' => 'Better Workflow Draft',
	'pi_version' => '1.0',
	'pi_author' => 'Loren Klingman',
	'pi_author_url' => 'https://github.com/wiseloren/betterworkflow_draft',
	'pi_description' => 'Create notes that only show for better workflow drafts or only show on the live site.',
	'pi_usage' => '# Better Workflow Draft #

Create notes that only show for better workflow drafts or only show on the live site.

## Parameters

* draft 
	* on  - _default_, will show only for a previewed draft
	* off - will show only for views on the website
* parse
	* inward - will cause the tags inside to not be parsed if the test fails

## Examples

{exp:betterworkflow_draft parse="inward"}You are viewing a betterworkflow preview.{/exp:betterworkflow_draft}

{exp:betterworkflow_draft parse="inward" draft="no"}You are viewing on the website.{/exp:betterworkflow_draft}',
);

/**
 * Better Workflow Draft
 *
 * Create notes that only show for better workflow drafts or only show on the live site.
 *
 * @author Loren Klingman
 * @link https://github.com/wiseloren/betterworkflow_draft
 * @version 1.0
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

		if ($this->EE->TMPL->fetch_param('draft') && $this->EE->TMPL->fetch_param('draft') == 'no') {
			if (isset($this->EE->session->cache['ep_better_workflow']['is_draft']) 
				&& $this->EE->session->cache['ep_better_workflow']['is_draft']) {
				$this->EE->TMPL->log_item('Better Workflow Draft: Skipping, this is a better workflow draft.');
				return '';
			}
		} else {
			if (!isset($this->EE->session->cache['ep_better_workflow']['is_draft']) 
				|| !$this->EE->session->cache['ep_better_workflow']['is_draft']) {
				$this->EE->TMPL->log_item('Better Workflow Draft: Skipping, this is not a better workflow draft.');
				return '';
			}
		}

		return $this->return_data = $this->EE->TMPL->tagdata;
	}
}

/* End of file pi.betterworkflow_draft.php */
/* Location: ./system/expressionengine/third_party/betterworkflow_draft/pi.betterworkflow_draft.php */