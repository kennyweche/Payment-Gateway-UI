<!DOCTYPE html>
<html>
    <head>
        <title>Input In Container Fixed To Top Of Viewport | datetimepicker Tests</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" type="text/css" href="{{ asset('/datetime_picker/jquery.datetimepicker.css') }} "/>

        <style>
            body {
                margin: 0;
                padding: 0;
            }
            main {
                width: 960px;
                margin: 0 auto;
            }
            #search {
                position: fixed;
                top: 0;
                z-index: 3;
                width: 100%;
                color: #f0f0f0;
                background-color: #333;
                opacity: 0.9;
                -webkit-opacity: 0.9;
                -moz-opacity: 0.9;
            }
            #search form {
                width: 960px;
                margin: 0 auto;
                padding: 0.5em;
            }
            #search form > div,
            #filters form > div {
                display: inline;
            }
        </style>
    </head>

    <body>
        <main>
            <h1>Input In Container Fixed To Top Of Viewport</h1>

            <div id="filters">
                <form method="post" action="?">
                    <div>
                        <label for="filter-date">Date</label>
                        <input type="text" name="filter-date" id="filter-date"/>
                    </div>

                    <div>
                        <input type="submit" value="Filter"/>
                    </div>
                </form>
            </div>


        </main>

        <footer>
            <div id="search">
                <form method="post" action="?">
                    <div>
                        <label for="search-from-date">Date from</label>
                        <input type="text" name="search-from-date" id="search-from-date"/>
                    </div>

                    <div>
                        <label for="search-to-date">Date to</label>
                        <input type="text" name="search-to-date" id="search-to-date"/>
                    </div>

                    <div>
                        <input type="submit" value="Search"/>
                    </div>
                </form>
            </div>
        </footer>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

        <script src="{{ asset('/datetime_picker/build/jquery.datetimepicker.full.js') }}"></script>

        <script>
            /*jslint browser:true*/
            /*global jQuery, document*/
            jQuery(document).ready(function () {
                'use strict';
                jQuery('#filter-date, #search-from-date, #search-to-date').datetimepicker();
            });
        </script>
    </body>
</html>