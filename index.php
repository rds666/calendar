<!DOCTYPE html>
<html lang="pl">
<head>
		<meta charset="utf-8">
		<title>Day Planner Pro</title>
		<link type="text/css" rel="stylesheet" href="assets/scss/style.css" />
		<script src="assets/js/jquery-1.9.1.min.js" type="text/javascript"></script>
        <script src="assets/js/daypilot/daypilot.js" type="text/javascript"></script>
</head>
<body>
		<header class="app-header">
				<img src="assets/images/logo.png" alt="Logo Day Planner Pro">
				<span>Day Planner Pro</span>
		</header>

		<main>
				<div>
						<div>nav</div>
				</div>
				<div>
						<div>dp</div>
				</div>
		</main>
	
		<script type="text/javascript">
                var nav = new DayPilot.Navigator("nav");
                nav.showMonths = 5;
                nav.skipMonths = 5;
                nav.selectMode = "week";
                nav.onTimeRangeSelected = function(args) {
                    dp.startDate = args.day;
                    dp.update();
                    loadEvents();
                };
                nav.init();

                var dp = new DayPilot.Calendar("dp");
                dp.viewType = "Week";

                dp.eventDeleteHandling = "Update";

                dp.onEventDeleted = function(args) {
                    $.post("event_delete.php",
                        {
                            id: args.e.id()
                        },
                        function() {
                            console.log("Usunięty.");
                        });
                };

                dp.onEventMoved = function(args) {
                    $.post("event_move.php",
                            {
                                id: args.e.id(),
                                newStart: args.newStart.toString(),
                                newEnd: args.newEnd.toString()
                            },
                            function() {
                                console.log("Przeniesiony.");
                            });
                };

                dp.onEventResized = function(args) {
                    $.post("event_change.php",
                            {
                                id: args.e.id(),
                                newStart: args.newStart.toString(),
                                newEnd: args.newEnd.toString()
                            },
                            function() {
                                console.log("Zeskalowany");
                            });
                };

                dp.onTimeRangeSelected = function(args) {
                    var name = prompt("Nazwa:", "Event");
					var note = prompt("Opis :", "Event");
                    dp.clearSelection();
                    if (!name) return;
                    var e = new DayPilot.Event({
                        start: args.start,
                        end: args.end,
                        id: DayPilot.guid(),
                        note: args.note,
                        text: name
                    });
                    dp.events.add(e);

                    $.post("event_create.php",
                            {
                                start: args.start.toString(),
                                end: args.end.toString(),
                                name: name,
								note: note
                            },
                            function() {
                                console.log("Stworzono.");
                            });

                };

                dp.onEventClick = function(args) {
					console.log(args);
                    alert("Data/Godzina: " + args.e.start() + " - " +  args.e.end() /*+ args.note*/);
                };

                dp.init();

                loadEvents();

                function loadEvents() {
                    dp.events.load("event_select.php");
                }

            </script>
		</div>
			<div class="clear">
		</div>
</body>
</html>