<% include SideBar %>

<div class="content-container unit size3of4 lastUnit">
	<% if $CarouselImages %>
		<ul class="carousel">
			<% loop $OrderedCarouselImages %>
				<li class="carousel-$Pos"><img src="$CroppedImage(600,200).URL" /></li>
			<% end_loop %>
		</ul>

		<style type="text/css">
			<% loop $CarouselStyle %>
				ul.carousel > .carousel-$Pos {
					animation: cycle{$Pos} {$Time}s linear infinite;
					z-index: $ZIndex;
				}

				@keyframes cycle{$Pos} {
					0% { opacity: 1; }
					{$TransitOutStart}% { opacity: 1; }
					{$TransitOutEnd}% { opacity: 0; }
					{$TransitInStart}% { opacity: 0; }
					100% { opacity: 1; }
				}
			<% end_loop %>
		</style>
	<% end_if %>

	<article>
		<h1>$Title</h1>
		<div class="content">$Content</div>
	</article>

	$Form
	$CommentsForm

	<% if TodoSets %>
		<h1>Let's get these things done!</h1>
		<ul class="todo-sets">
			<% loop TodoSets %>
				<li>$TodoForm</li>
			<% end_loop %>
		</ul>
	<% end_if %>
</div>