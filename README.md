# Better Workflow Draft #

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

{/exp:channel:entries}

## Changes
* 1.1.1
	* Fixed a php error
* 1.1
	* Fixed a bug with the way previews are handled and changed the draft parameter values
	* The default value has changed and is now to show for any preview not just a draft
* 1.0
	* Initial Release