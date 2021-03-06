;( function( $, window, undefined ) {	
	'use strict';
	$.Calendario = function( options, element ) {
		this.$el = $( element );
		this._init( options );
	};

	// the options
	$.Calendario.defaults = {
		weeks : [ bkng_messages.Sunday, bkng_messages.Monday, bkng_messages.Tuesday, bkng_messages.Wednesday, bkng_messages.Thursday, bkng_messages.Friday, bkng_messages.Saturday ],
		weekabbrs : [ bkng_messages.Sun, bkng_messages.Mon, bkng_messages.Tue, bkng_messages.Wed, bkng_messages.Thu, bkng_messages.Fri, bkng_messages.Sat ],
		months : [ bkng_messages.January, bkng_messages.February, bkng_messages.March, bkng_messages.April, bkng_messages.May, bkng_messages.June, bkng_messages.July, bkng_messages.August, bkng_messages.September, bkng_messages.October, bkng_messages.November, bkng_messages.December ],
		monthabbrs : [ bkng_messages.Jan, bkng_messages.Feb, bkng_messages.Mar, bkng_messages.Apr, bkng_messages.May, bkng_messages.Jun, bkng_messages.Jul, bkng_messages.Aug, bkng_messages.Sep, bkng_messages.Oct, bkng_messages.Nov, bkng_messages.Dec ],
		displayWeekAbbr : false,
		displayMonthAbbr : false,
		startIn : 0,
		onDayClick : function( $el, $content, dateProperties ) { 
			return false;
		}
	};
	$.Calendario.prototype = {
		_init : function( options ) {			
			// options
			this.options = $.extend( true, {}, $.Calendario.defaults, options );
			this.today = new Date();
			this.month =  ( isNaN( this.options.month ) || this.options.month == null) ? this.today.getMonth() : this.options.month - 1;
			this.year = ( isNaN( this.options.year ) || this.options.year == null) ? this.today.getFullYear() : this.options.year;
			this.caldata = this.options.caldata || {};
			this._generateTemplate();
		},
		/*_initEvents : function() {
      		var self = this;
			this.$el.on( 'click.calendario', 'div.fc-row > div', function() {

				var $cell = $( this ),
					idx = $cell.index(),
					$content = $cell.children( 'div' ),
					dateProp = {
						day : $cell.children( 'span.fc-date' ).text(),
						month : self.month + 1,
						monthname : self.options.displayMonthAbbr ? self.options.monthabbrs[ self.month ] : self.options.months[ self.month ],
						year : self.year,
						weekday : idx + self.options.startIn,
						weekdayname : self.options.weeks[ idx + self.options.startIn ]
					};
 
				if( dateProp.day ) {self.options.onDayClick( $cell, $content, dateProp );}
			} );
		},*/
		_generateTemplate : function( callback ) {
			var head = this._getHead(),	body = this._getBody(),	rowClass;
			switch( this.rowTotal ) {
				case 4 : rowClass = 'fc-four-rows'; break;
				case 5 : rowClass = 'fc-five-rows'; break;
				case 6 : rowClass = 'fc-six-rows'; break;
			}
			this.$cal = $('<div class="fc-calendar '+rowClass+'">').append( head,body );
			this.$el.find( 'div.fc-calendar' ).remove().end().append( this.$cal );
			if( callback ) { callback.call(); }
			updateDateCount();
		},
		_getHead : function() {
			var html = '<div class="fc-head">';		
			for ( var i = 0; i <= 6; i++ ) {
				var pos = i + this.options.startIn,
					j = pos > 6 ? pos - 6 - 1 : pos;
				html += '<div>';
				html += this.options.displayWeekAbbr ? this.options.weekabbrs[ j ] : this.options.weeks[ j ];
				html += '</div>';
			}
			html += '</div>';
			return html;
		},
		_getBody : function() {

			var d = new Date(this.year, this.month+1,0),	monthLength = d.getDate(),firstDay = new Date(this.year,this.month,1);
			this.startingDay = firstDay.getDay();

			var html = '<div class="fc-body"><div class="fc-row">',	day = 1;
			for ( var i = 0; i < 7; i++ ) {
				var date_current = '';
				for ( var j = 0; j <= 6; j++ ) {
					date_current = '';
					var pos = this.startingDay - this.options.startIn,
						p = pos < 0 ? 6 + pos + 1 : pos,
						inner = '',
						today = this.month === this.today.getMonth() && this.year === this.today.getFullYear() && day === this.today.getDate(),
						content = '';	 
									
					if ( day <= monthLength && ( i > 0 || j >= p ) ) {

						var mon = this.month + 1;
						if (mon > 12) mon = 1;

						if (mon < 10)
							mon = ("0"+mon).toString();

						if (day < 10)
							day = ("0"+day).toString();

						date_current =  day+"-"+mon+"-"+this.year;

						inner += '<span class="fc-date ">'+day+'</span><span class="fc-weekday">'+this.options.weekabbrs[j+this.options.startIn>6?j+this.options.startIn-6-1: j+this.options.startIn]+'</span><span class="fc-total-booking"></span>';

						var strdate = (this.month+1<10?'0'+(this.month+1): this.month+1)+'-'+(day<10?'0'+day: day)+'-'+this.year,dayData = this.caldata[ strdate ];
						if( dayData ) {content = dayData;}
						if( content !== '' ) {inner += '<div>' + content + '</div>';}
						++day;
					}
					var cellClasses = today ? 'fc-today ' : '';
					if( content !== '' ) {cellClasses += 'fc-content';}

					var past_class = '';

					var current_date_full = new Date(this.year, mon-1, day);
					if (current_date_full.getUTCDate()) {
						if (current_date_full.getTime() < this.today.getTime()){
							past_class = 'past-date';
						}
					}

					html += cellClasses !== '' ? '<div class="cell-day ' + cellClasses + '" data-date-attr="'+date_current+'">' : '<div class="cell-day '+ past_class +'" data-date-attr="'+date_current+'">';
					html += inner;
					html += '</div>';
				}

				// stop making rows if we've run out of days
				if (day > monthLength) {
					this.rowTotal = i + 1;
					break;
				} 
				else {html += '</div><div class="fc-row">';}
			}
			html += '</div></div>';
			return html;
		},

		_isValidDate : function( date ) {

			date = date.replace(/-/gi,'');
			var month = parseInt( date.substring( 0, 2 ), 10 ),
				day = parseInt( date.substring( 2, 4 ), 10 ),
				year = parseInt( date.substring( 4, 8 ), 10 );
			if( ( month < 1 ) || ( month > 12 ) ) {return false;}
			else if( ( day < 1 ) || ( day > 31 ) )  {
				return false;
			}
			else if((( month == 4) || (month == 6) || (month == 9) || (month == 11)) && (day > 30))  {
				return false;
			}
			else if((month == 2) && (((year % 400) == 0) || ((year % 4) == 0)) && ((year % 100) != 0) && (day > 29)) {
				return false;
			}
			else if((month == 2) && ((year % 100) == 0) && (day > 29) )  {return false;}
			return {day : day,month : month,year : year};
		},
		_move : function( period, dir, callback ) {

			if( dir === 'previous' ) {				
				if( period === 'month' ) {
					this.year = this.month > 0 ? this.year : --this.year;
					this.month = this.month > 0 ? --this.month : 11;
				}
				else if( period === 'year' ) {this.year = --this.year;}
			}
			else if( dir === 'next' ) {
				if( period === 'month' ) {
					this.year = this.month < 11 ? this.year : ++this.year;
					this.month = this.month < 11 ? ++this.month : 0;
				}
				else if( period === 'year' ) {this.year = ++this.year;}
			}
			this._generateTemplate( callback );
		},
		getYear : function() {return this.year;},
		getMonth : function() {return this.month + 1;},
		getMonthName : function() {
			return this.options.displayMonthAbbr ? this.options.monthabbrs[ this.month ] : this.options.months[ this.month ];
		},
		getCell : function( day ) {

			var row = Math.floor( ( day + this.startingDay - this.options.startIn ) / 7 ),
				pos = day + this.startingDay - this.options.startIn - ( row * 7 ) - 1;
			return this.$cal.find( 'div.fc-body' ).children( 'div.fc-row' ).eq( row ).children( 'div' ).eq( pos ).children( 'div' );

		},
		setData : function( caldata ) {
			caldata = caldata || {};
			$.extend( this.caldata, caldata );
			this._generateTemplate();
		},
		// goes to today's month/year
		gotoNow : function( callback ) {
			this.month = this.today.getMonth();
			this.year = this.today.getFullYear();
			this._generateTemplate( callback );
		},
		// goes to month/year
		goto : function( month, year, callback ) {
			this.month = month;
			this.year = year;
			this._generateTemplate( callback );
		},
		gotoPreviousMonth : function( callback ) {
			this._move( 'month', 'previous', callback );
			updateDateCount();
		},
		gotoPreviousYear : function( callback ) {
			this._move( 'year', 'previous', callback );
		},
		gotoNextMonth : function( callback ) {
			this._move( 'month', 'next', callback );
			updateDateCount();
		},
		gotoNextYear : function( callback ) {
			this._move( 'year', 'next', callback );
		}
	};
		var logError = function( message ) {
		if ( window.console ) {window.console.error( message );}
	};
		$.fn.calendario = function( options ) {
		var instance = $.data( this, 'calendario' );		
		if ( typeof options === 'string' ) {			
			var args = Array.prototype.slice.call( arguments, 1 );			
			this.each(function() {			
				if ( !instance ) {
					logError( "cannot call methods on calendario prior to initialization; " +
					"attempted to call method '" + options + "'" );
					return;				
				}
				if ( !$.isFunction( instance[options] ) || options.charAt(0) === "_" ) {
					logError( "no such method '" + options + "' for calendario instance" );
					return;				
				}
				instance[ options ].apply( instance, args );			
			});		
		} 
		else {		
			this.each(function() {				
				if ( instance ) {instance._init();}
				else {instance = $.data( this, 'calendario', new $.Calendario( options, this ) );}
			});
		}
		return instance;
	};
})(jQuery,window);

var codropsEvents = {};