/**

 * 

 */



			$(document).ready(function() {

			    // Search input text handling on focus

					var $searchq = $("#search-q").attr("value");

				    $('#search-q.text').css('color', '#999');

					$('#search-q').focus(function(){

						if ( $(this).attr('value') == $searchq) {

							$(this).css('color', '#555');

							$(this).attr('value', '');

						}

					});

					$('#search-q').blur(function(){

						if ( $(this).attr('value') == '' ) {

							$(this).attr('value', $searchq);

							$(this).css('color', '#999');

						}

					});

				// Switch categories

					$('#h-wrap').hover(function(){

							$(this).toggleClass('active');

							$("#h-wrap ul").css('display', 'block');

						}, function(){

							$(this).toggleClass('active');

							$("#h-wrap ul").css('display', 'none');

					});

				// Handling with tables (adding first and last classes for borders and adding alternate bgs)

					$('tbody tr:even').addClass('even');

					$('table.grid tbody tr:last-child').addClass('last');

					$('tr th:first-child, tr td:first-child').addClass('first');

					$('tr th:last-child, tr td:last-child').addClass('last');

					$('form.fields fieldset:last-child').addClass('last');

				// Handling with lists (alternate bgs)

					$('ul.simple li:even').addClass('even');

				// Handling with grid views (adding first and last classes for borders and adding alternate bgs)

					$('.grid .line:even').addClass('even');

					$('.grid .line:first-child').addClass('firstline');

					$('.grid .line:last-child').addClass('lastline');

				// Tabs switching

					/*$('#box1 .content#box1-grid').hide(); // hide content related to inactive tab by default
                    $('#box1 .content#box1-newest').hide();
                    $('#box1 .content#box1-contact').hide();
                    $('#box1 .content#box1-money').hide();
                    $('#box1 .content#box1-creatives').hide();
                    $('#box1 .content#box1-rules').hide();*/

                                        /* for prospects changes 20082011 starts */
                                        $('#box1 .content#box1-tabular-tabs').hide();
                                        $('#box1 .content#box1-visit-tabs').hide();
                                        $('#box1 .content#box1-contact-tabs').hide();
                                        $('#box1 .content#box1-money-tabs').hide();
                                        $('#box1 .content#box1-newest-tabs').hide();
                                        $('#box1 .content#box1-downline-tabs').hide();
                                        /* for prospects changes 20082011 ends */

                                        /* changes 30082011 lead management starts */
                                        $('#box1 .content#box1-lead-sources-tabs').hide();
                                        $('#box1 .content#box1-lead-uploadcsv-tabs').hide();
                                        $('#box1 .content#box1-lead-leadselection-tabs').hide();
                                        /* changes 30082011 lead management ends */
                                        
                                        /* for geneology */
                                        $('#box1 .content#box1-enroll-tabs').hide();
                                        


					$('#box1 .header ul a').click(function(){

						$('#box1 .header ul a').removeClass('active');

						$(this).addClass('active'); // make clicked tab active

						$('#box1 .content').hide(); // hide all content

						$('#box1').find('#' + $(this).attr('rel')).show(); // and show content related to clicked tab

						return false;

					});
					
					// Tabs switching at login
					
					$('#box1 .content_login#login-lostpassword').hide();
                                      $('#box1 .header ul a').click(function(){

						$('#box1 .header ul a').removeClass('active');

						$(this).addClass('active'); // make clicked tab active

						$('#box1 .content_login').hide(); // hide all content

						$('#box1').find('#' + $(this).attr('rel')).show(); // and show content related to clicked tab

						return false;

					});


                    // Tabs switching

					$('#box80.content#box80-grid').hide(); // hide content related to inactive tab by default

					$('#box80 .header ul a').click(function(){

						$('#box80 .header ul a').removeClass('active');

						$(this).addClass('active'); // make clicked tab active

						$('#box80 .content').hide(); // hide all content

						$('#box80').find('#' + $(this).attr('rel')).show(); // and show content related to clicked tab

						return false;

					});
					
					$('#nav .menuHolder ul a').click(function(){
					$(this).addClass('active'); // make clicked tab active
						

						//$('#nav .menuHolder ul a').removeClass('active');

						
					});

			});

function itemsperpage(itemperpage,url,ordertab,url1)
{
    if(url1 == '')
    {
      url1 = 'prospects/list';
    }else{
      url1 = url1;
    }
    window.location= url+'index.php/'+url1+'/?itemperpage='+itemperpage+'&ordertab='+ordertab;
}