# Article Craft Plugin #

[![Build Status](https://travis-ci.org/experience/article.craft-plugin.svg?branch=master)](https://travis-ci.org/experience/article.craft-plugin)

Matrix is an incredibly powerful way of building "article" pages comprised of different content blocks; text, quotes, images, code, and so forth.

Markdown is perfect for writing textual content quickly and intuitively, without getting lost in WYSIWONT hell.

Matrix and Markdown must be a match made in heaven, right? Not quite.

When you're authoring the content, it all works splendidly. When it comes time to render everything on the page, it all becomes rather tricky.

Accidentally included a bit of whitespace in your template, in just the wrong place? Well done, your entire article is now a code block. Working with footnotes? Splendid, you've now got footnotes at the bottom of each Matrix block, rather than at the end of the article.

It's possible, but it's painful. Article isn't a magic bullet, but it does relieve the worst suffering.

## Requirements ##
Article converts your Matrix field into a Markdown string, and renders it using [Smartdown][smartdown]. As such, you must have Smartdown version 2.1.0 or greater installed and activated in order to use Article.

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

All you need to do is tell Article where to find your templates, relative to the `CRAFT_TEMPLATES_PATH`, by configuring the "templates path" on the Article settings page.

### How it works ###
Article looks in your templates directory for a template which matches the handle of the current Matrix block.

For example, let's say you tell Article that your templates live in the `articles/_blocks` directory, and your Matrix field contains a block with the handle `text`.

Article will look for the following templates. If one of them exists, it will use it to render the Matrix block:

- `articles/_blocks/text.html`
- `articles/_blocks/text.twig`

The supported template extensions are controlled by [Craft's `defaultTemplateExtensions` config setting][template-extensions].

[template-extensions]: https://craftcms.com/docs/config-settings#defaultTemplateExtensions

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

## Gotchas ##
Article isn't a mind-reader, and it doesn't attempt to change the way Markdown works. That way madness lies.

As such, if you want to wrap your content with HTML tags, but still parse it as Markdown, you'll need to let Article (or, more precisely, PHP Markdown Extra) know.

You do this by adding [the `markdown="1"` attribute][markdown-attribute] to the wrapping tag:

[markdown-attribute]: https://michelf.ca/projects/php-markdown/extra/#markdown-attr

```
<div class="content-block" markdown="1">
This text is _italic_, and wrapped in paragraph tags.
</div>
```

PHP Markdown Extra automatically removes the `markdown="1"` attribute, ensuring your HTML remains nice and clean.

## Credits ##
[Newspaper icon][icon] by [unlimicon][icon-author] from the [Noun Project][noun-project].

[icon]: https://thenounproject.com/term/newspaper/697578
[icon-author]: https://thenounproject.com/unlimicon/
[noun-project]:https://thenounproject.com 


