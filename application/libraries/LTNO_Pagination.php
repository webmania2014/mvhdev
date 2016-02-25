<?php if( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );
/**
 * Pagination extended library
 * Extends CI pagination class and customized methods
 *
 * @package     CodeIgniter 2.2.0
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc.
 */

class LTNO_Pagination extends CI_Pagination {
	/**
	 * @access public
	 * @var    $show_inactive
	 *
	 * It makes to display previous, and next link even in the state of same with current page link.
	 * Originally, previous does not display if the current page is the first page and 
	 * next does not display if the current page is the last page.
	 */
	var $show_inactive = FALSE;

	/**
	 * Constructor
	 *
	 * @access	public
	 * @param	array	initialization parameters
	 */
	public function __construct($params = array())
	{
		parent::__construct( $params );

		if(isset($params['anchor_class']) && $params['anchor_class'] != '')
		{
			$this->anchor_class = $params['anchor_class'];
		}
	}

	// --------------------------------------------------------------------

	/**
	 * Initialize Preferences
	 *
	 * @access	public
	 * @param	array	initialization parameters
	 * @return	void
	 */
	function initialize($params = array())
	{
		parent::initialize( $params );
	}

	/**
	 * Generate the pagination links
	 *
	 * @access	public
	 * @return	string
	 */
	function create_links()
	{
		// If our item count or per-page total is zero there is no need to continue.
		if ($this->total_rows == 0 OR $this->per_page == 0)
		{
			return '';
		}

		// Calculate the total number of pages
		$num_pages = ceil($this->total_rows / $this->per_page);

		// Is there only one page? Hm... nothing more to do here then.
		if ($num_pages == 1)
		{
			return '';
		}

		// Set the base page index for starting page number
		if ($this->use_page_numbers)
		{
			$base_page = 1;
		}
		else
		{
			$base_page = 0;
		}

		// Determine the current page number.
		$CI =& get_instance();

		if ($CI->config->item('enable_query_strings') === TRUE OR $this->page_query_string === TRUE)
		{
			if ($CI->input->get($this->query_string_segment) != $base_page)
			{
				$this->cur_page = $CI->input->get($this->query_string_segment);

				// Prep the current page - no funny business!
				$this->cur_page = (int) $this->cur_page;
			}
		}
		else
		{
			if ($CI->uri->segment($this->uri_segment) != $base_page)
			{
				$this->cur_page = $CI->uri->segment($this->uri_segment);

				// Prep the current page - no funny business!
				$this->cur_page = (int) $this->cur_page;
			}
		}
		
		// Set current page to 1 if using page numbers instead of offset
		if ($this->use_page_numbers AND $this->cur_page == 0)
		{
			$this->cur_page = $base_page;
		}

		$this->num_links = (int)$this->num_links;

		if ($this->num_links < 1)
		{
			show_error('Your number of links must be a positive number.');
		}

		if ( ! is_numeric($this->cur_page))
		{
			$this->cur_page = $base_page;
		}

		// Is the page number beyond the result range?
		// If so we show the last page
		if ($this->use_page_numbers)
		{
			if ($this->cur_page > $num_pages)
			{
				$this->cur_page = $num_pages;
			}
		}
		else
		{
			if ($this->cur_page > $this->total_rows)
			{
				$this->cur_page = ($num_pages - 1) * $this->per_page;
			}
		}

		$uri_page_number = $this->cur_page;
		
		if ( ! $this->use_page_numbers)
		{
			$this->cur_page = floor(($this->cur_page/$this->per_page) + 1);
		}

		// Calculate the start and end numbers. These determine
		// which number to start and end the digit links with
		$start = (($this->cur_page - $this->num_links) > 0) ? $this->cur_page - ($this->num_links - 1) : 1;
		$end   = (($this->cur_page + $this->num_links) < $num_pages) ? $this->cur_page + $this->num_links : $num_pages;

		// Is pagination being used over GET or POST?  If get, add a per_page query
		// string. If post, add a trailing slash to the base URL if needed
		if ($CI->config->item('enable_query_strings') === TRUE OR $this->page_query_string === TRUE)
		{
			$this->base_url = rtrim($this->base_url).'&amp;'.$this->query_string_segment.'=';
		}
		else
		{
			$this->base_url = rtrim($this->base_url, '/') .'/';
		}

		// And here we go...
		$output = '';

		// Render the "First" link
		if ($this->first_link !== FALSE AND ($this->cur_page > ($this->num_links + 1) OR $this->show_inactive !== FALSE))
		{
			if( $this->cur_page > 1 ) {
				if( $this->anchor_class != '' ) {
					$anchor_class = 'class="%s" ';
					$this->anchor_class = ( $this->cur_page != 1 ) ? sprintf( $anchor_class, $this->anchor_class ) : sprintf( $anchor_class, 'active disabled ' . $this->anchor_class ); 
				}

				$first_url = ($this->first_url == '') ? $this->base_url : $this->first_url;
				$output .= $this->first_tag_open.'<a '.$this->anchor_class.'href="'.$first_url.'">'.$this->first_link.'</a>'.$this->first_tag_close;	
			} else {
				$anchor_class = 'active disabled';

				if( $this->anchor_class != '' ) {
					$anchor_class .= $this->anchor_class;
				}

				$output .= $this->first_tag_open.'<a class="'.$anchor_class.'" href="javascript:;">'.$this->first_link.'</a>'.$this->first_tag_close;
			}
		}
		

		// Render the "previous" link
		if  ($this->prev_link !== FALSE AND ($this->cur_page != 1 OR $this->show_inactive !== FALSE))
		{
			if( $this->anchor_class != '' ) {
				$anchor_class = 'class="%s" ';
				$this->anchor_class = ( $this->cur_page != 1 ) ? sprintf( $anchor_class, $this->anchor_class ) : sprintf( $anchor_class, 'active disabled ' . $this->anchor_class ); 
			}

			if( $this->cur_page != 1 ) {
				if( $this->anchor_class != '' ) {
					$this->anchor_class = 'class="' . $this->anchor_class . '" '; 
				}

				if ($this->use_page_numbers)
				{
					$i = $uri_page_number - 1;
				}
				else
				{
					$i = $uri_page_number - $this->per_page;
				}

				if ($i == 0 && $this->first_url != '')
				{
					$output .= $this->prev_tag_open.'<a '.$this->anchor_class.'href="'.$this->first_url.'">'.$this->prev_link.'</a>'.$this->prev_tag_close;
				}
				else
				{
					$i = ($i == 0) ? '' : $this->prefix.$i.$this->suffix;
					$output .= $this->prev_tag_open.'<a '.$this->anchor_class.'href="'.$this->base_url.$i.'">'.$this->prev_link.'</a>'.$this->prev_tag_close;
				}
			} else {
				$anchor_class = 'active disabled remove';

				if( $this->anchor_class != '' ) {
					$anchor_class .= $this->anchor_class;
				}

				$output .= $this->prev_tag_open.'<a class="'.$anchor_class.'" href="javascript:;">'.$this->prev_link.'</a>'.$this->prev_tag_close;
			}
		}
		

		// Render the pages
		if ($this->display_pages !== FALSE)
		{
			// Write the digit links
			for ($loop = $start -1; $loop <= $end; $loop++)
			{
				if ($this->use_page_numbers)
				{
					$i = $loop;
				}
				else
				{
					$i = ($loop * $this->per_page) - $this->per_page;
				}

				if ($i >= $base_page)
				{
					if ($this->cur_page == $loop)
					{
						$output .= $this->cur_tag_open.$loop.$this->cur_tag_close; // Current page
					}
					else
					{
						$n = ($i == $base_page) ? '' : $i;

						if ($n == '' && $this->first_url != '')
						{
							$output .= $this->num_tag_open.'<a '.$this->anchor_class.'href="'.$this->first_url.'">'.$loop.'</a>'.$this->num_tag_close;
						}
						else
						{
							$n = ($n == '') ? '' : $this->prefix.$n.$this->suffix;

							$output .= $this->num_tag_open.'<a '.$this->anchor_class.'href="'.$this->base_url.$n.'">'.$loop.'</a>'.$this->num_tag_close;
						}
					}
				}
			}
		}

		// Render the "next" link
		if ($this->next_link !== FALSE AND ($this->cur_page < $num_pages OR $this->show_inactive !== FALSE))
		{
			if( $this->cur_page < $num_pages ) {
				if( $this->anchor_class != '' ) {
					$this->anchor_class = 'class="' . $this->anchor_class . '" '; 
				}

				if ($this->use_page_numbers)
				{
					$i = $this->cur_page + 1;
				}
				else
				{
					$i = ($this->cur_page * $this->per_page);
				}

				$output .= $this->next_tag_open.'<a '.$this->anchor_class.'href="'.$this->base_url.$this->prefix.$i.$this->suffix.'">'.$this->next_link.'</a>'.$this->next_tag_close;
			} else {
				$anchor_class = 'active disabled remove';

				if( $this->anchor_class != '' ) {
					$anchor_class .= $this->anchor_class;
				}

				$output .= $this->next_tag_open.'<a class="'.$anchor_class.'" href="javascript:;" class="disabled active">'.$this->next_link.'</a>'.$this->next_tag_close;
			}
		}

		// Render the "Last" link
		if ($this->last_link !== FALSE AND (($this->cur_page + $this->num_links) < $num_pages OR $this->show_inactive !== FALSE))
		{
			if( ( $this->cur_page + $this->num_links ) < $num_pages ) {
				
				if( $this->anchor_class != '' ) {
					$this->anchor_class = 'class="' . $this->anchor_class . '" '; 
				}

				if ($this->use_page_numbers)
				{
					$i = $num_pages;
				}
				else
				{
					$i = (($num_pages * $this->per_page) - $this->per_page);
				}
				$output .= $this->last_tag_open.'<a '.$this->anchor_class.'href="'.$this->base_url.$this->prefix.$i.$this->suffix.'">'.$this->last_link.'</a>'.$this->last_tag_close;
			} else {
				$anchor_class = 'active disabled';

				if( $this->anchor_class != '' ) {
					$anchor_class .= $this->anchor_class;
				}

				$output .= $this->last_tag_open.'<a class="'.$anchor_class.'" href="javascript:;" class="disabled active">'.$this->last_link.'</a>'.$this->last_tag_close;
			}
		}

		// Kill double slashes.  Note: Sometimes we can end up with a double slash
		// in the penultimate link so we'll kill all double slashes.
		$output = preg_replace("#([^:])//+#", "\\1/", $output);

		// Add the wrapper HTML if exists
		$output = $this->full_tag_open.$output.$this->full_tag_close;

		return $output;
	}
}


/* End */
/* Location: `application/libraries/LTNO_Pagination.php` */