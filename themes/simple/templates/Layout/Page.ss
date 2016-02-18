<% include SideBar %>

<div class="content-container unit size3of4 lastUnit">
	<article>
		<h1>$Title</h1>
		<div class="content">$Content</div>
	</article>

	$Form
	$CommentsForm

	<% if $TodoSets %>
		<h1>Let's get these things done!</h1>
		<ul class="todo-sets">
			<% loop $TodoSets %>
				<li>$TodoForm</li>
			<% end_loop %>
		</ul>
	<% end_if %>
</div>
