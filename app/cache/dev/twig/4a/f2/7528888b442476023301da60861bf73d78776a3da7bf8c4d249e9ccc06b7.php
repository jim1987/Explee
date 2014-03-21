<?php

/* ExpleeTestBundle:Default:index.html.twig */
class __TwigTemplate_4af27528888b442476023301da60861bf73d78776a3da7bf8c4d249e9ccc06b7 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("::base.html.twig");

        $this->blocks = array(
            'stylesheets' => array($this, 'block_stylesheets'),
            'body' => array($this, 'block_body'),
            'javascripts' => array($this, 'block_javascripts'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "::base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 4
        echo "<style>
</style>
";
    }

    // line 8
    public function block_body($context, array $blocks = array())
    {
        // line 9
        echo "
<div class=\"container\">

<div class=\"row\">

<div class=\"col-xs-3\">
<p class=\"lead\">search twitter:</p>
<input type=\"text\" id=\"condition\" class=\"form-control\" value=\"\"/><br/>
<input type=\"submit\" id=\"searchTwitter\"  class=\"form-control\" value=\"search\"/>
<br/>
<p id=\"twitterContent\"></p>
</div>

<div class=\"col-xs-3\">
<p class=\"lead\">status du compte:</p>
<input type=\"submit\" id=\"getStatus\" class=\"form-control\" value=\"Get\"/>
<br/>
<p id=\"compteStatus\"></p>
</div>

<div class=\"col-xs-3\">
<p class=\"lead\">follow compte 14642331:</p>
<input type=\"submit\" id=\"followSomeone\" class=\"btn btn-primary form-control\" value=\"follow\"/><br/>
<p class=\"lead\">unfollow compte 14642331:</p>
<input type=\"submit\" id=\"unFollowSomeone\" class=\"form-control btn btn-primary\" value=\"unfollow\"/><br/><br/>
<p id=\"alertMsg\"></p>
</div>

<div class=\"col-xs-3\">
<p class=\"lead\">write your twitter:</p>
<textarea id=\"newTwitter\" class=\"form-control\"></textarea><br/>
<input type=\"submit\" id=\"publishTwitter\" class=\"form-control\" value=\"publish\"/>
<br/>
<p id=\"newTwitterContent\"></p>
</div>

</div>

</div>

";
    }

    // line 51
    public function block_javascripts($context, array $blocks = array())
    {
        // line 52
        echo "<script>
\$(function() {

    /*search twitter*/
    \$(\"#searchTwitter\").click(function(e) {
    
        e.preventDefault();
        
        var con = \$(\"#condition\").val();
        var htmlDom = \"\";
        
        //var path = Routing.generate('search_twitter', {con: con}, false);        
        //alert(path);
        
        \$(\"#twitterContent\").hide(\"slow\");
        \$.ajax({
            type: 'GET',
            url: Routing.generate('search_twitter', {con: con}, false),
            dataType: \"json\",
            success: function(data, textStatus) {
            \t\t
\t\t\t\t  var data = JSON.parse(data); //eval\t\t\t\t  
\t\t\t\t  \$.each(data, function(key, item) {
\t\t\t           htmlDom +=\"<div><strong>\" + item.created_at + \"</strong></div>\" + 
\t\t\t                    \"<div>\" + item.text    + \"</div>\" +
\t\t\t                    \"<div><strong><em>\" + item.lang + \"</em></strong></div><hr/>\";
\t\t\t        });
\t\t\t      
\t\t\t      \$(\"#twitterContent\").html(htmlDom);
\t\t\t\t  \$(\"#twitterContent\").show(\"slow\"); 
                  
            },
            error: function(XMLHttpRequest, textStatus, errorThrown){
            \talert(errorThrown);
            }
         });
       });  
      
        /*get compte status*/
 \t\t\$(\"#getStatus\").click(function(e) {
    
        e.preventDefault();
        
        var htmlDom = \"\";
        
        \$(\"#compteStatus\").hide(\"slow\");
        \$.ajax({
            type: 'GET',
            url: Routing.generate('get_status', false),
            dataType: \"json\",
            success: function(data, textStatus) {
            \t\t
\t\t\t\t  var data = JSON.parse(data); 
\t\t\t
\t\t\t  \t\thtmlDom +=\"<div><strong>PROFIL: </strong><img src='\"+data.profile_image_url+\"'/></div>\"+
\t\t\t  \t\t\t\t  \"<div><strong>ID: </strong>\" + data.id + \"</div>\" + 
\t\t                      \"<div><strong>NAME: </strong>\" + data.name    + \"</div>\" +
\t\t                      \"<div><strong>SCREEN NAME: </strong>\" + data.screen_name + \"</div>\"+
\t\t                      \"<div><strong>CREATED AT: </strong>\" + data.created_at + \"</div>\"+
\t\t                      \"<div><strong>NEW TWITTER: </strong> \" + data.text + \"</div><hr/>\";
\t\t\t\t
\t\t\t\t  
\t\t\t      \$(\"#compteStatus\").html(htmlDom);
\t\t\t\t  \$(\"#compteStatus\").show(\"slow\"); 
                  
            },
            error: function(XMLHttpRequest, textStatus, errorThrown){
            \talert(errorThrown);
            }
          });       
       });
       
       /*follow someone*/
       \$(\"#followSomeone\").bind(\"click\",function(e) {
          twitterSomeone(e,\"follow\");    
       });
       
       /*unfollow someone*/
       \$(\"#unFollowSomeone\").bind(\"click\",function(e) {
          twitterSomeone(e,\"unfollow\");    
       });  
       
       function twitterSomeone(e,action){
       \t\te.preventDefault();
        
\t        var htmlDom = \"\";
\t        var action = action;
\t        
\t        \$(\"#alertMsg\").hide(\"slow\");
\t        \$.ajax({
\t            type: 'GET',
\t            url: Routing.generate('twitter_someone',{action: action}, false),
\t            dataType: \"json\",
\t            success: function(data, textStatus) {
\t            \t\t
\t\t\t\t\t  var data = JSON.parse(data); 
\t\t\t\t
\t\t\t\t  \t\thtmlDom += \"<div><strong>stauts: \" + data.status + \"</strong></div>\";
\t
\t\t\t\t      \$(\"#alertMsg\").html(htmlDom);
\t\t\t\t\t  \$(\"#alertMsg\").show(\"slow\"); 
\t                  
\t            },
\t            error: function(XMLHttpRequest, textStatus, errorThrown){
\t            \talert(errorThrown);
\t            }
\t          }); 
       }
       
       /*publish a twitter*/
       \$(\"#publishTwitter\").click(function(e) {
    
        e.preventDefault();
        
        var text = \$(\"#newTwitter\").val();
        var htmlDom = \"\";
        
        \$(\"#newTwitterContent\").hide(\"slow\");
        \$.ajax({
            type: 'GET',
            url: Routing.generate('publish_twitter', {text: text}, false),
            dataType: \"json\",
            success: function(data, textStatus) {
            \t\t
\t\t\t\t  var data = JSON.parse(data); \t\t\t  
\t\t\t\t  //alert(data);
\t\t\t      htmlDom += \"<div><strong>Publish time:</strong> \" + data.created_at + \"</div>\"+
\t\t\t       \t\t     \"<div><strong>Message:</strong> \" + data.text + \"</div>\";
\t\t\t      
\t\t\t      \$(\"#newTwitterContent\").html(htmlDom);
\t\t\t\t  \$(\"#newTwitterContent\").show(\"slow\"); 
                  
            },
            error: function(XMLHttpRequest, textStatus, errorThrown){
            \talert(errorThrown);
            }
         });
       }); 
});
</script>
";
    }

    public function getTemplateName()
    {
        return "ExpleeTestBundle:Default:index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  89 => 52,  86 => 51,  42 => 9,  39 => 8,  33 => 4,  30 => 3,);
    }
}
