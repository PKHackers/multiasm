{%if printformat is not defined%}{%set printformat = '%s' %}{%endif%}
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<title>{%block title%}MPASM{%endblock%}{%if description%} - {{description}}{%endif%}</title>
		<link rel="stylesheet" type="text/css" href="{{rootdir}}mpasm.css"/>
		{%block header%}{%endblock%}
	</head>
<body>
	{%if hideright != true%}<div class="right">
		{%if gamelist is not empty%}<select onchange="top.location.href = '{{rootdir}}' + this.options[this.selectedIndex].value">
{%for gameval,game in gamelist%}			<option value="{{gameval}}"{%if title == game%} selected="yes"{%endif%}>{{game}}</option>
{%endfor%}		</select>{%endif%}

{%if nextoffset%}<a rel="next" accesskey="n" href="{{rootdir}}{{coremod}}/{{nextoffset}}">Next Data</a>{%endif%}
{%if notes%}<br /><h3>notes</h3>{{notes|replace({"\n":"<br />"})|raw}}{%endif%}
{%if form%}
		<form action="/index.php">
			<input type="hidden" name="coremod" value="{{coremod}}">
			<label>Offset<input type="text" value="{{offsetname}}" name="param"></label><br />{%for option in options%}{%if (user.admin) or (option.adminonly != true)%}
			<label>{{option.label}}<input type="{{option.type}}" value="{{option.value}}" name="{{option.id}}"></label><br />{%endif%}{%endfor%}
	
			<input type="submit" value="Submit">
		</form>{%endif%}
		
	</div>{%endif%}

	<div class="menu"><div>
{%block menu%}{%for url,menuitem in menuitems%}		<a href="#{{url}}">{{menuitem}}</a><br />
{%endfor%}{%endblock%}
	</div></div>
{%for error in errors %}<div class="minorerror">{{error}}</div><br />{%endfor%}
	<span class="{%if error%}error{%else%}top{%endif%}" title="{%for key,comment in comments%}
{{key}}:{{comment}} 
{%endfor%}">{{title}}{%if description%} - {{description}}{%endif%}</span>
	<pre{%if error%} class="error"{%endif%}>
{%block content%}{%endblock%}	</pre>
	<small>{%for url,submod in submods%}<a href="{{rootdir}}{{coremod}}/{{url}}">{{submod}}</a> {%endfor%}</small>
</body>
</html>