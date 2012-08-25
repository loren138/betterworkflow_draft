# Better Workflow Draft #

Create notes that only show for better workflow drafts or only show on the live site.

## Parameters

* draft 
	* on  - _default_, will show only for a previewed draft
	* off - will show only for views on the website
* parse
	* inward - will cause the tags inside to not be parsed if the test fails

## Examples

{exp:betterworkflow_draft parse="inward"}You are viewing a betterworkflow preview.{/exp:betterworkflow_draft}

{exp:betterworkflow_draft parse="inward" draft="no"}You are viewing on the website.{/exp:betterworkflow_draft}