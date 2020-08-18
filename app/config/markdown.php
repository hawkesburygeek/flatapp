<?php

/**
 * The following configuration values are adapted from the original
 * author of the Markdown parser being used. More information can be
 * found at:
 * http://michelf.ca/projects/php-markdown/configuration/
 */

return array(
	/**
	 * This is the string used to close tags for HTML elements with
	 * no content such as <br> and <hr>. The default value creates
	 * XML-style empty element tags which are also valid in HTML 5.
	 */
	'empty_element_suffix' => ' />',

	/**
	 * This is the width of a tab character on input. Changing this will
	 * affect how many spaces a tab character represents.
	 *
	 * Note: Keep in mind that when the Markdown syntax spec says “four spaces or one tab”,
	 * it actually means “four spaces after tabs are expanded to spaces”. So setting
	 * tab_width to 8 will make parser treat a tab character as two levels of indentation.
	 */
	'tab_width' => 4,

	/**
	 * Setting this variable to true will prevent HTML tags
	 * in the input from being passed to the output.
	 */
	'no_markup' => FALSE,

	/**
	 * Setting this variable to true will prevent HTML entities (such as &lt;)
	 * from being passed verbatim in the output as it is the standard with Markdown.
	 * Instead, the HTML output will be &amp;tl; and once shown in shown the browser
	 * it will match perfectly what was written.
	 */
	'no_entities' => FALSE,

	/**
	 * You can predefine reference links by setting predef_urls to a list of urls where
	 * the key is the name of the reference.
	 */
	'predef_urls' => array(),

	/**
	 * Use predef_titles to set the title of the link references passed in
	 * predef_urls. As for predef_urls, the key is the reference name.
	 */
	'predef_titles' => array(),

	/**
	 * A prefix for the id attributes generated by footnotes. This is useful if
	 * you have multiple Markdown documents displayed inside one HTML document to
	 * avoid footnote ids to clash each other.
	 */
	'fn_id_prefix' => '',

	/**
	 * An optional title attribute for footnotes links and backlinks. Browsers
	 * usually show this as a tooltip when the mouse is over the link.
	 */
	'fn_link_title' => '',
	'fn_backlink_title' => '',

	/**
	 * The class attribute to use for footnotes links and backlinks.
	 */
	'fn_link_class' => '',
	'fn_backlink_class' => '',

	/**
	 * An optional prefix for the class names associated with fenced code blocks.
	 */
	'code_class_prefix' => '',

	/**
	 * When set to false (the default), attributes for code blocks will go on the
	 * <code> tag; setting this to true will put attributes on the <pre> tag instead.
	 */
	'code_attr_on_pre' => FALSE,

	/**
	 * You can predefine abbreviations by setting predef_abbr to a list of abbreviations
	 * where the key is the text of the abbreviation and the value is the expanded name.
	 */
	'predef_abbr' => array(),

);