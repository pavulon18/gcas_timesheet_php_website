<html>
    <head>
        <link type="text/css" rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" />
        <link type="text/css" href="//code.cloudcms.com/alpaca/{{site.alpaca_version}}/bootstrap/alpaca.min.css" rel="stylesheet" />
        <script type="text/javascript" src="//code.jquery.com/jquery-1.11.1.min.js"></script>
        <script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.0.5/handlebars.js"></script>
        <script type="text/javascript" src="//code.cloudcms.com/alpaca/{{site.alpaca_version}}/bootstrap/alpaca.min.js"></script>
    </head>
    <body>
        <div id="form"></div>
        <script type="text/javascript">
            $(document).ready(function() {
                $("#form").alpaca({
                    "data": {
                        "name": "Diego Maradona",
                        "feedback": "Very impressive.",
                        "ranking": "excellent"
                    },
                    "schema": {
                        "title":"User Feedback",
                        "description":"What do you think about Alpaca?",
                        "type":"object",
                        "properties": {
                            "name": {
                                "type":"string",
                                "title":"Name",
                                "required":true
                            },
                            "feedback": {
                                "type":"string",
                                "title":"Feedback"
                            },
                            "ranking": {
                                "type":"string",
                                "title":"Ranking",
                                "enum":['excellent','ok','so so'],
                                "required":true
                            }
                        }
                    },
                    "options": {
                        "form":{
                            "attributes":{
                                "action":"http://httpbin.org/post",
                                "method":"post"
                            },
                            "buttons":{
                                "submit":{
                                    "title": "Send Form Data",
                                    "click": function() {
                                        var val = this.getValue();
                                        if (this.isValid(true)) {
                                            alert("Valid value: " + JSON.stringify(val, null, "  "));
                                            this.ajaxSubmit().done(function() {
                                                alert("Posted!");
                                            });
                                        } else {
                                            alert("Invalid value: " + JSON.stringify(val, null, "  "));
                                        }
                                    }
                                }
                            }
                        },
                        "helper": "Tell us what you think about Alpaca!",
                        "fields": {
                            "name": {
                                "size": 20,
                                "helper": "Please enter your name."
                            },
                            "feedback" : {
                                "type": "textarea",
                                "name": "your_feedback",
                                "rows": 5,
                                "cols": 40,
                                "helper": "Please enter your feedback."
                            },
                            "ranking": {
                                "type": "select",
                                "helper": "Select your ranking.",
                                "optionLabels": ["Awesome!",
                                    "It's Ok",
                                    "Hmm..."]
                            }
                        }
                    },
                    "postRender": function(control) {
                        control.childrenByPropertyId["name"].getFieldEl().css("background-color", "lightgreen");
                    }
                });
            });
        </script>
    </body>
</html>
