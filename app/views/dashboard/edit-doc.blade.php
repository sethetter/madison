@extends('layouts/main')
@section('content')
{{ HTML::style('vendor/pagedown/assets/demo.css') }}
{{ HTML::script('vendor/pagedown/assets/Markdown.Editor.js') }}
{{ HTML::script('vendor/pagedown/assets/Markdown.Sanitizer.js') }}
<div class="row">
	<ol class="breadcrumb">
		<li><a href="/dashboard">Dashboard</a></li>
		<li><a href="/dashboard/docs">Documents</a></li>
		<li class="active">{{ $doc->title }}</li>
	</ol>
</div>
<div class="row content" ng-controller="DashboardEditorController" ng-init="init()">
	<div class="col-md-12">
	{{ Form::open(array('url' => 'dashboard/docs/' . $doc->id, 'method' => 'put', 'id'=>'doc_content_form',
		'class' => 'form-horizontal', 'style' => 'style="padding: 0 50px; border: 1px dotted lightgray;"')) }}
		<tabset justified="true">
			<tab heading="Document Content">
				<div class="row">
					<input type="hidden" name="content_id" value="{{{ $contentItem->id }}}"/>
					<div class="row">
						<h2>Content</h2>
							<input type="hidden" name="content_id" value="{{{ $contentItem->id }}}" ng-model="doc.content.id"/>

							<div class="doc_item_content">
								<div id="wmd-button-bar"></div>
								<textarea class="wmd-input" id="wmd-input" name="content" ng-model="doc.content.content"
									>{{{ $contentItem->content }}}</textarea>
								<div id="wmd-preview" class="wmd-panel wmd-preview"></div>
								<script type="text/javascript">
									var doc = {
										id: {{ $doc->id }}
									}
								</script>
							</div>
						{{ Form::hidden('doc_id', $doc->id) }}
						<div class="form_actions">
							{{ Form::submit('Save Doc', array('name' => 'submit', 'id' => 'submit', 'class'=>'btn')) }}
						</div>
						<div id="save_message" class="alert hidden"></div>
					</div>
					{{ Form::token() . Form::close() }}
				</div>
			</tab>
			<tab heading="Document Information">
				<div class="row">
					<h2>Document Information</h2>
					<div class="form-group">
						<label for="status" class="col-sm-2">Status: </label>
						<div class="col-sm-10">
							<input name="status" type="hidden" ui-select2="statusOptions" ng-model="status" data-placeholder="">
						</div>
					</div>
					<div class="form-group">
						<label for="title" class="col-sm-2">Title: </label>
						<div class="col-sm-10">
							<input type="text" name="title" id="title" value="{{{ $doc->title }}}" ng-model="doc.title" style="margin-left:20px;width:85%;padding:5px;"/>
						</div>
					</div>
					<div class="form-group">
						<label for="slug" class="col-sm-2">Slug: </label>
						<div class="col-sm-10">
							<span class="instructions">a-z (lowercase), 0-9, and "-" only.</span>
							<input type="text" name="slug" id="slug" value="{{{ $doc->slug }}}" ng-model="doc.slug" style="margin-left:20px;width:85%;padding:5px;"/>
						</div>
					</div>
					<div class="form-group">
						<label for="sponsor" class="col-sm-2">Sponsor: </label>
						<div class="col-sm-10">
							<input type="hidden" ui-select2="sponsorOptions" ng-model="sponsor" data-placeholder="Select Document Sponsor" id="sponsor">
						</div>
					</div>
					<div class="form-group">
						<label for="categories" class="col-sm-2">Categories: </label>
						<div class="col-sm-10">
							<input type="hidden" ui-select2="categoryOptions" ng-model="categories" />
						</div>
					</div>
					<div class="form-group">
						<label for="dates">Dates: </label>
						<div class="dates">
							<div class="new-date">
								<input ng-model="newdate.label" type="text" placeholder="Date Label" />
								<datetimepicker ng-model="newdate.date" on-set-time="createDate"></datetimepicker>
							</div>
							<div class="existing-dates">
								<div class="existing-date" ng-repeat="date in dates">
									<div class="date-label"><% date.label%></div>
									<div class="date-date"><% date.date | date:short%></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</tab>
		</tabset>
	</div>
</div>
@endsection
