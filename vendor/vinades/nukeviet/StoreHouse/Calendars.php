<?php

class Calendars 
{
	/**
	 * Calendar layout template
	 *
	 * @var mixed
	 */
	public $template = '';

	/**
	 * Replacements array for template
	 *
	 * @var array
	 */
	public $replacements = array();

	/**
	 * Day of the week to start the calendar on
	 *
	 * @var string
	 */
	public $start_day = 'monday';

	/**
	 * How to display months
	 *
	 * @var string
	 */
	public $month_type = 'long';

	/**
	 * How to display names of days
	 *
	 * @var string
	 */
	public $day_type = 'abr';

	/**
	 * Whether to show next/prev month links
	 *
	 * @var bool
	 */
	public $show_next_prev = FALSE;

	/**
	 * Url base to use for next/prev month links
	 *
	 * @var bool
	 */
	public $next_prev_url = '';

	/**
	 * Show days of other months
	 *
	 * @var bool
	 */
	public $show_other_days = FALSE;
	
	protected $CI;
	
    function __construct($config = array())
    {
    	$this->CI =& get_instance();
        empty($config) OR $this->initialize($config);
		
    }
	public function initialize($config = array())
	{
		foreach ($config as $key => $val)
		{
			if (isset($this->$key))
			{
				$this->$key = $val;
			}
		}

		

		return $this;
	}
	public function generate($year = '', $month = '', $data = array())
	{
		$local_time = time();

		// Set and validate the supplied month/year
		if (empty($year))
		{
			$year = date('Y', $local_time);
		}
		elseif (strlen($year) === 1)
		{
			$year = '200'.$year;
		}
		elseif (strlen($year) === 2)
		{
			$year = '20'.$year;
		}

		if (empty($month))
		{
			$month = date('m', $local_time);
		}
		elseif (strlen($month) === 1)
		{
			$month = '0'.$month;
		}

		$adjusted_date = $this->adjust_date($month, $year);
		
		$month	= $adjusted_date['month'];
		$year	= $adjusted_date['year'];

		// Determine the total days in the month
		$total_days = $this->get_total_days($month, $year);

		// Set the starting day of the week
		$start_days	= array('sunday' => 0, 'monday' => 1, 'tuesday' => 2, 'wednesday' => 3, 'thursday' => 4, 'friday' => 5, 'saturday' => 6);
		$start_day	= isset($start_days[$this->start_day]) ? $start_days[$this->start_day] : 0;

		// Set the starting day number
		$local_date = mktime(12, 0, 0, $month, 1, $year);
		$date = getdate($local_date);
		$day  = $start_day + 1 - $date['wday'];

		while ($day > 1)
		{
			$day -= 7;
		}

		// Set the current month/year/day
		// We use this to determine the "today" date
		$cur_year	= date('Y', $local_time);
		$cur_month	= date('m', $local_time);
		$cur_day	= date('j', $local_time);

		$is_current_month = ($cur_year == $year && $cur_month == $month);

		// Generate the template data array
		$this->parse_template();

		// Begin building the calendar output
		$out = $this->replacements['table_open']."\n\n".$this->replacements['heading_row_start']."\n";
		
		// "previous" month link
		if ($this->show_next_prev === TRUE)
		{
			// Add a trailing slash to the URL if needed
			$this->next_prev_url = preg_replace('/(.+?)\/*$/', '\\1/', $this->next_prev_url);

			$adjusted_date = $this->adjust_date($month - 1, $year);
			$out .= str_replace('{previous_url}', $this->next_prev_url.$adjusted_date['year'].'/'.$adjusted_date['month'], $this->replacements['heading_previous_cell'])."\n";
		}

		// Heading containing the month/year
		$colspan = ($this->show_next_prev === TRUE) ? 5 : 7;

		$this->replacements['heading_title_cell'] = str_replace('{colspan}', $colspan,
								str_replace('{heading}', $this->get_month_name($month).'&nbsp;'.$year, $this->replacements['heading_title_cell']));

		$out .= $this->replacements['heading_title_cell']."\n";

		// "next" month link
		if ($this->show_next_prev === TRUE)
		{
			$adjusted_date = $this->adjust_date($month + 1, $year);
			$out .= str_replace('{next_url}', $this->next_prev_url.$adjusted_date['year'].'/'.$adjusted_date['month'], $this->replacements['heading_next_cell']);
		}

		$out .= "\n".$this->replacements['heading_row_end']."\n\n"
			// Write the cells containing the days of the week
			.$this->replacements['week_row_start']."\n";

		$day_names = $this->get_day_names();
		
		for ($i = 0; $i < 7; $i ++)
		{
			$out .= str_replace('{week_day}', $day_names[($start_day + $i) %7], $this->replacements['week_day_cell']);
		}

		$out .= "\n".$this->replacements['week_row_end']."\n";

		// Build the main body of the calendar
		while ($day <= $total_days)
		{
			$out .= "\n".$this->replacements['cal_row_start']."\n";

			for ($i = 0; $i < 7; $i++)
			{
				if ($day > 0 && $day <= $total_days)
				{
					$out .= ($is_current_month === TRUE && $day == $cur_day) ? $this->replacements['cal_cell_start_today'] : $this->replacements['cal_cell_start'];

					if (isset($data[$day]))
					{
						// Cells with content
						$temp = ($is_current_month === TRUE && $day == $cur_day) ?
								$this->replacements['cal_cell_content_today'] : $this->replacements['cal_cell_content'];
						$out .= str_replace(array('{content}', '{day}'), array($data[$day], $day), $temp);
					}
					else
					{
						// Cells with no content
						$temp = ($is_current_month === TRUE && $day == $cur_day) ?
								$this->replacements['cal_cell_no_content_today'] : $this->replacements['cal_cell_no_content'];
						$out .= str_replace('{day}', $day, $temp);
					}

					$out .= ($is_current_month === TRUE && $day == $cur_day) ? $this->replacements['cal_cell_end_today'] : $this->replacements['cal_cell_end'];
				}
				elseif ($this->show_other_days === TRUE)
				{
					$out .= $this->replacements['cal_cell_start_other'];

					if ($day <= 0)
					{
						// Day of previous month
						$prev_month = $this->adjust_date($month - 1, $year);
						$prev_month_days = $this->get_total_days($prev_month['month'], $prev_month['year']);
						$out .= str_replace('{day}', $prev_month_days + $day, $this->replacements['cal_cell_other']);
					}
					else
					{
						// Day of next month
						$out .= str_replace('{day}', $day - $total_days, $this->replacements['cal_cell_other']);
					}

					$out .= $this->replacements['cal_cell_end_other'];
				}
				else
				{
					// Blank cells
					$out .= $this->replacements['cal_cell_start'].$this->replacements['cal_cell_blank'].$this->replacements['cal_cell_end'];
				}

				$day++;
			}

			$out .= "\n".$this->replacements['cal_row_end']."\n";
		}

		return $out .= "\n".$this->replacements['table_close'];
	}
	public function adjust_date($month, $year)
	{
		$date = array();

		$date['month']	= $month;
		$date['year']	= $year;

		while ($date['month'] > 12)
		{
			$date['month'] -= 12;
			$date['year']++;
		}

		while ($date['month'] <= 0)
		{
			$date['month'] += 12;
			$date['year']--;
		}

		if (strlen($date['month']) === 1)
		{
			$date['month'] = '0'.$date['month'];
		}

		return $date;
	}
	public function get_total_days($month, $year)
	{
		
		return days_in_month($month, $year);
	}
	public function parse_template()
	{
		$this->replacements = $this->default_template();

		if (empty($this->template))
		{
			return $this;
		}

		if (is_string($this->template))
		{
			$today = array('cal_cell_start_today', 'cal_cell_content_today', 'cal_cell_no_content_today', 'cal_cell_end_today');

			foreach (array('table_open', 'table_close', 'heading_row_start', 'heading_previous_cell', 'heading_title_cell', 'heading_next_cell', 'heading_row_end', 'week_row_start', 'week_day_cell', 'week_row_end', 'cal_row_start', 'cal_cell_start', 'cal_cell_content', 'cal_cell_no_content', 'cal_cell_blank', 'cal_cell_end', 'cal_row_end', 'cal_cell_start_today', 'cal_cell_content_today', 'cal_cell_no_content_today', 'cal_cell_end_today', 'cal_cell_start_other', 'cal_cell_other', 'cal_cell_end_other') as $val)
			{
				if (preg_match('/\{'.$val.'\}(.*?)\{\/'.$val.'\}/si', $this->template, $match))
				{
					$this->replacements[$val] = $match[1];
				}
				elseif (in_array($val, $today, TRUE))
				{
					$this->replacements[$val] = $this->replacements[substr($val, 0, -6)];
				}
			}
		}
		elseif (is_array($this->template))
		{
			$this->replacements = array_merge($this->replacements, $this->template);
		}

		return $this;
	}
	public function default_template()
	{
		return array(
			'table_open'				=> '<table border="0" cellpadding="4" cellspacing="0">',
			'heading_row_start'			=> '<tr>',
			'heading_previous_cell'		=> '<th><a href="{previous_url}">&lt;&lt;</a></th>',
			'heading_title_cell'		=> '<th colspan="{colspan}">{heading}</th>',
			'heading_next_cell'			=> '<th><a href="{next_url}">&gt;&gt;</a></th>',
			'heading_row_end'			=> '</tr>',
			'week_row_start'			=> '<tr>',
			'week_day_cell'				=> '<td>{week_day}</td>',
			'week_row_end'				=> '</tr>',
			'cal_row_start'				=> '<tr>',
			'cal_cell_start'			=> '<td>',
			'cal_cell_start_today'		=> '<td>',
			'cal_cell_start_other'		=> '<td style="color: #666;">',
			'cal_cell_content'			=> '<a href="{content}">{day}</a>',
			'cal_cell_content_today'	=> '<a href="{content}"><strong>{day}</strong></a>',
			'cal_cell_no_content'		=> '{day}',
			'cal_cell_no_content_today'	=> '<strong>{day}</strong>',
			'cal_cell_blank'			=> '&nbsp;',
			'cal_cell_other'			=> '{day}',
			'cal_cell_end'				=> '</td>',
			'cal_cell_end_today'		=> '</td>',
			'cal_cell_end_other'		=> '</td>',
			'cal_row_end'				=> '</tr>',
			'table_close'				=> '</table>'
		);
	}
	public function get_month_name($month)
	{
		if ($this->month_type === 'short')
		{
			$month_names = array('01' => 'cal_jan', '02' => 'cal_feb', '03' => 'cal_mar', '04' => 'cal_apr', '05' => 'cal_may', '06' => 'cal_jun', '07' => 'cal_jul', '08' => 'cal_aug', '09' => 'cal_sep', '10' => 'cal_oct', '11' => 'cal_nov', '12' => 'cal_dec');
		}
		else
		{
			$month_names = array('01' => 'cal_january', '02' => 'cal_february', '03' => 'cal_march', '04' => 'cal_april', '05' => 'cal_mayl', '06' => 'cal_june', '07' => 'cal_july', '08' => 'cal_august', '09' => 'cal_september', '10' => 'cal_october', '11' => 'cal_november', '12' => 'cal_december');
		}

		return empty($this->CI->lang[$month_names[$month]]) ? ucfirst(substr($month_names[$month], 4)) : $this->CI->lang[$month_names[$month]];
	}
	public function get_day_names($day_type = '')
	{
		if ($day_type !== '')
		{
			$this->day_type = $day_type;
		}

		if ($this->day_type === 'long')
		{
			$day_names = array('sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday');
		}
		elseif ($this->day_type === 'short')
		{
			$day_names = array('sun', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat');
		}
		else
		{
			$day_names = array('su', 'mo', 'tu', 'we', 'th', 'fr', 'sa');
		}

		$days = array();
		for ($i = 0, $c = count($day_names); $i < $c; $i++)
		{
			$days[] =  $this->CI->lang[$day_names[$i]];
		}
		return $days;
	}
  /*
    public function index()
      {
          $this->data['cal_lang'] = $this->get_cal_lang();
          $bc = array(array('link' => base_url(), 'page' => lang('home')), array('link' => '#', 'page' => lang('calendar')));
          $meta = array('page_title' => lang('calendar'), 'bc' => $bc);
          $this->page_construct('calendar', $meta, $this->data);
      }
  
      public function get_events()
      {
          $cal_lang = $this->get_cal_lang();
          $this->load->library('fc', array('lang' => $cal_lang));
  
          if (!isset($_GET['start']) || !isset($_GET['end'])) {
              die("Please provide a date range.");
          }
  
          if ($cal_lang == 'ar') {
              $start = $this->fc->convert2($this->input->get('start', true));
              $end = $this->fc->convert2($this->input->get('end', true));
          } else {
              $start = $this->input->get('start', true);
              $end = $this->input->get('end', true);
          }
  
          $input_arrays = $this->calendar_model->getEvents($start, $end);
          $start = $this->fc->parseDateTime($start);
          $end = $this->fc->parseDateTime($end);
          $output_arrays = array();
          foreach ($input_arrays as $array) {
              $this->fc->load_event($array);
              if ($this->fc->isWithinDayRange($start, $end)) {
                  $output_arrays[] = $this->fc->toArray();
              }
          }
  
          // $this->sma->send_json($output_arrays);
          $this->sma->send_json($output_arrays);
      }
  
      public function add_event()
      {
  
          $this->form_validation->set_rules('title', lang("title"), 'trim|required');
          $this->form_validation->set_rules('start', lang("start"), 'required');
  
          if ($this->form_validation->run() == true) {
              $data = array(
                  'title' => $this->input->post('title'),
                  'start' => $this->sma->fld($this->input->post('start')),
                  'end' => $this->input->post('end') ? $this->sma->fld($this->input->post('end')) : NULL,
                  'description' => $this->input->post('description'),
                  'color' => $this->input->post('color') ? $this->input->post('color') : '#000000',
                  'user_id' => $this->session->userdata('user_id')
                  );
  
              if ($this->calendar_model->addEvent($data)) {
                  $res = array('error' => 0, 'msg' => lang('event_added'));
                  $this->sma->send_json($res);
              } else {
                  $res = array('error' => 1, 'msg' => lang('action_failed'));
                  $this->sma->send_json($res);
              }
          }
  
      }
  
      public function update_event()
      {
  
          $this->form_validation->set_rules('title', lang("title"), 'trim|required');
          $this->form_validation->set_rules('start', lang("start"), 'required');
  
          if ($this->form_validation->run() == true) {
              $id = $this->input->post('id');
              if($event = $this->calendar_model->getEventByID($id)) {
                  if(!$this->Owner && $event->user_id != $this->session->userdata('user_id')) {
                      $res = array('error' => 1, 'msg' => lang('access_denied'));
                      $this->sma->send_json($res);
                  }
              }
              $data = array(
                  'title' => $this->input->post('title'),
                  'start' => $this->sma->fld($this->input->post('start')),
                  'end' => $this->input->post('end') ? $this->sma->fld($this->input->post('end')) : NULL,
                  'description' => $this->input->post('description'),
                  'color' => $this->input->post('color') ? $this->input->post('color') : '#000000',
                  'user_id' => $this->session->userdata('user_id')
                  );
  
              if ($this->calendar_model->updateEvent($id, $data)) {
                  $res = array('error' => 0, 'msg' => lang('event_updated'));
                  $this->sma->send_json($res);
              } else {
                  $res = array('error' => 1, 'msg' => lang('action_failed'));
                  $this->sma->send_json($res);
              }
          }
  
      }
  
      public function delete_event($id)
      {
          if($this->input->is_ajax_request()) {
              if($event = $this->calendar_model->getEventByID($id)) {
                  if(!$this->Owner && $event->user_id != $this->session->userdata('user_id')) {
                      $res = array('error' => 1, 'msg' => lang('access_denied'));
                      $this->sma->send_json($res);
                  }
                  $this->db->delete('calendar', array('id' => $id));
                  $res = array('error' => 0, 'msg' => lang('event_deleted'));
                  $this->sma->send_json($res);
              }
          }
      }*/
  

    public function get_cal_lang() {
    	print_r($this->Settings->user_language);die;
        switch ($this->Settings->user_language) {
            case 'arabic':
            $cal_lang = 'ar-ma';
            break;
            case 'french':
            $cal_lang = 'fr';
            break;
            case 'german':
            $cal_lang = 'de';
            break;
            case 'italian':
            $cal_lang = 'it';
            break;
            case 'portuguese-brazilian':
            $cal_lang = 'pt-br';
            break;
            case 'simplified-chinese':
            $cal_lang = 'zh-tw';
            break;
            case 'spanish':
            $cal_lang = 'es';
            break;
            case 'thai':
            $cal_lang = 'th';
            break;
            case 'traditional-chinese':
            $cal_lang = 'zh-cn';
            break;
            case 'turkish':
            $cal_lang = 'tr';
            break;
            case 'vietnamese':
            $cal_lang = 'vi';
            break;
            default:
            $cal_lang = 'en';
            break;
        }
        return $cal_lang;
    }

}
