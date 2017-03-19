# Article Craft Plugin #

[![Build Status](https://travis-ci.org/experience/article.craft-plugin.svg?branch=master)](https://travis-ci.org/experience/article.craft-plugin)

Article has been built to solve a very specific problem: parsing Markdown-formatted content in Matrix fields. In particular, Markdown-formatted content which contains footnotes.

You may be wondering why that requires a plugin.

The truth is, it doesn't. You can achieve the same end result through a careful combination of Twig macros, includes, shouting, and despair. Article is just easier.

## Requirements ##
Article uses [Smartdown][smartdown] to render your Markdown-formatted content. You must have version 2.1.0 or above installed and activated.

[smartdown]: https://github.com/experience/smartdown.craft-plugin "Bringing the unbridled joy of Markdown Extra and Smartypants to your Craft websites."

Each release of Article is [automatically tested][build-status] against PHP 5.5 and above. It is also manually tested on the most recent version of Craft.

[build-status]: https://travis-ci.org/experience/article.craft-plugin "See the Article build status on Travis CI"

## Installation ##

1. [Download the latest release][download], and unzip it.
2. Copy the `article` folder to your `craft/plugins` directory.
3. Navigate to the "Admin &rarr; Settings &rarr; Plugins" page, and activate Article.
4. Configure Article, as described in the next section.

[download]: https://github.com/experience/article.craft-plugin/releases/download/0.0.0/article-0.0.0.zip "Download the latest release"

## Configuration ##
Article makes no assumptions regarding the structure of your Matrix field, or the templates used to render the content.

You just need to tell Article where to find your templates, relative to the `CRAFT_TEMPLATES_PATH`, by configuring the "templates path" on the Article settings page.

## Usage ##
There are three ways to use Article:

- As a Craft service.
- As a template variable.
- As a Twig filter.

### Service ###
The Article service exposes a single method, `render`. The method accepts a Matrix field, and returns the parsed content.

```
$content = craft()->article->render($entry->matrixField);
```

### Template variable ###
Article exposes a single template variable, `render`. As with the service method of the same name, it accepts a Matrix field, and returns parsed content.

```
{{ craft.article.render(entry.matrixField)|raw }}
```

Note the you _must_ use the `raw` filter, otherwise Twig will auto-escape any HTML tags.

### Twig filter ###
Article exposes a single Twig filter, `renderArticle`.

```
{{ entry.matrixField|renderArticle }}
```

Note that, unlike the template variable, you _do not_ need to use the `raw` filter.

## Templates ##

### Overview ###
When it comes time to parse your Matrix field, Article uses the templates in your templates directory to render the content of each Matrix block.

In short, Article looks for a file with the same name as the `handle` of the Matrix block.

For example, let's say your templates directory is `articles/_blocks`, and your Matrix block has a `handle` of "text".

In this case, Article will look for the following templates. If one of them exists, it will use it to render the Matrix block:

- `articles/_blocks/text.html`
- `articles/_blocks/text.twig`

The supported template extensions are controlled by [Craft's `defaultTemplateExtensions` config setting][template-extensions].

[template-extensions]: https://craftcms.com/docs/config-settings#defaultTemplateExtensions

### The `block` template variable ###
Each template has access to a single variable, `block`, which is the MatrixBlockModel for the current block.

So, if your `text` block type contains a `body` field, you can access it as follows:

```
{{ block.body }}
```

## Tips and tricks ##
Article isn't a mind-reader, and it doesn't make any assumptions regarding the content of your templates.

This section includes a few tips and tricks, which should make it a little easier to author Article-friendly templates.

### Use the `raw` filter ###
Apply the `raw` filter to Markdown-formatted content, as follows:

```
{{ block.markdownField|raw }}
```

If you don't Twig will try its utmost to convert your carefully crafted Markdown into HTML entities, resulting in non-parsed Markdown links, quotes, and so forth.

Applying the `raw` filter is a simple fix, which will save you countless headaches.

### Tell Article if you have Markdown inside HTML ###
If you wrap your Markdown-formatted content with HTML tags, you'll need to let Article (or, more precisely, PHP Markdown Extra) know.

You do this by adding [the `markdown="1"` attribute][markdown-attribute] to the wrapping tag:

[markdown-attribute]: https://michelf.ca/projects/php-markdown/extra/#markdown-attr

```
<div class="content-block" markdown="1">
This text is _italic_, and wrapped in paragraph tags.
</div>
```

PHP Markdown Extra automatically removes the `markdown="1"` attribute, ensuring your HTML remains nice and clean.

### Eliminate whitespace ###
Markdown is _very_ whitespace-sensitive. If you suddenly find your content riddled with unwanted code blocks, it's very likely that leading whitespace is the culprit.

Here's how to solve that:

```
<div markdown="1">
    {{- block.markdownField -}}
</div>
```

If you want to know more, Twig's documentation contains [detailed information about whitespace control][twig-whitespace].

[twig-whitespace]: http://twig.sensiolabs.org/doc/1.x/templates.html#templates-whitespace-control

## Credits ##
[Newspaper icon][icon] by [unlimicon][icon-author] from the [Noun Project][noun-project].

[icon]: https://thenounproject.com/term/newspaper/697578
[icon-author]: https://thenounproject.com/unlimicon/
[noun-project]:https://thenounproject.com 


