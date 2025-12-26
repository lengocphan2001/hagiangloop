@extends('layouts.app')

@section('title', $page->meta_title ?? $page->title)

@section('description', $page->meta_description)

@section('content')
    <div class="min-h-screen bg-white py-4">
        <div class="container mx-auto px-4">
            <div class="tinymce-content">
                {!! $page->content !!}
            </div>
        </div>
    </div>
@stop

@section('styles')
    <style>
        /* Reset Tailwind defaults that might interfere */
        .tinymce-content * {
            box-sizing: border-box;
        }
        
        .tinymce-content {
            font-family: Helvetica, Arial, sans-serif !important;
            font-size: 16px !important;
            line-height: 1.75 !important;
            color: #374151 !important;
            /* Reset any Tailwind resets */
            all: revert;
        }
        
        .tinymce-content h1,
        .tinymce-content h2,
        .tinymce-content h3,
        .tinymce-content h4,
        .tinymce-content h5,
        .tinymce-content h6 {
            all: revert;
            display: block;
            font-weight: 700;
            color: #111827;
        }
        
        .tinymce-content h1 {
            font-size: 2.25em !important;
            font-weight: 700 !important;
            color: #111827 !important;
            margin-top: 0 !important;
            margin-bottom: 0.8888889em !important;
            line-height: 1.1111111 !important;
        }
        .tinymce-content h2 {
            font-size: 1.5em !important;
            font-weight: 700 !important;
            color: #111827 !important;
            margin-top: 2em !important;
            margin-bottom: 1em !important;
            line-height: 1.3333333 !important;
        }
        .tinymce-content h3 {
            font-size: 1.25em !important;
            font-weight: 700 !important;
            color: #111827 !important;
            margin-top: 1.6em !important;
            margin-bottom: 0.6em !important;
            line-height: 1.6 !important;
        }
        .tinymce-content h4 {
            font-size: 1.125em !important;
            font-weight: 600 !important;
            color: #111827 !important;
            margin-top: 1.5555556em !important;
            margin-bottom: 0.4444444em !important;
            line-height: 1.5555556 !important;
        }
        .tinymce-content h5 {
            font-size: 1em !important;
            font-weight: 600 !important;
            color: #111827 !important;
            margin-top: 1.5em !important;
            margin-bottom: 0.5em !important;
            line-height: 1.5 !important;
        }
        .tinymce-content h6 {
            font-size: 0.875em !important;
            font-weight: 600 !important;
            color: #111827 !important;
            margin-top: 1.5em !important;
            margin-bottom: 0.5em !important;
            line-height: 1.5 !important;
        }
        
        /* Custom classes from TinyMCE */
        .tinymce-content .title {
            font-size: 2.25em !important;
            font-weight: 700 !important;
            color: #111827 !important;
            margin-top: 0 !important;
            margin-bottom: 1em !important;
            line-height: 1.2 !important;
        }
        
        .tinymce-content .description {
            font-size: 16px !important;
            line-height: 1.75 !important;
            color: #374151 !important;
        }
        
        .tinymce-content .description h2 {
            font-size: 1.5em !important;
            font-weight: 700 !important;
            color: #111827 !important;
            margin-top: 1.5em !important;
            margin-bottom: 1em !important;
            line-height: 1.3333333 !important;
        }
        
        .tinymce-content .description p {
            margin-top: 1.25em !important;
            margin-bottom: 1.25em !important;
        }
        
        .tinymce-content .description ul {
            margin-top: 1.25em !important;
            margin-bottom: 1.25em !important;
            padding-left: 1.625em !important;
        }
        
        .tinymce-content .description ul ul {
            margin-top: 0.5em !important;
            margin-bottom: 0.5em !important;
            padding-left: 1.25em !important;
        }
        
        .tinymce-content .description img {
            max-width: 100% !important;
            height: auto !important;
            border-radius: 0.5rem !important;
            margin: 2em 0 !important;
            display: block !important;
        }
        
        .tinymce-content .description p img {
            margin: 0 !important;
        }
        .tinymce-content p {
            margin-top: 1.25em !important;
            margin-bottom: 1.25em !important;
            display: block !important;
        }
        .tinymce-content ul,
        .tinymce-content ol {
            margin-top: 1.25em !important;
            margin-bottom: 1.25em !important;
            padding-left: 1.625em !important;
            display: block !important;
            list-style-position: outside !important;
        }
        .tinymce-content ul {
            list-style-type: disc !important;
        }
        .tinymce-content ol {
            list-style-type: decimal !important;
        }
        .tinymce-content li {
            margin-top: 0.5em !important;
            margin-bottom: 0.5em !important;
            display: list-item !important;
        }
        .tinymce-content strong,
        .tinymce-content b {
            font-weight: 600 !important;
            color: #111827 !important;
        }
        .tinymce-content em,
        .tinymce-content i {
            font-style: italic !important;
        }
        .tinymce-content a {
            color: #f59e0b !important;
            text-decoration: underline !important;
        }
        .tinymce-content a:hover {
            color: #d97706 !important;
        }
        .tinymce-content img {
            max-width: 100% !important;
            height: auto !important;
            border-radius: 0.5rem !important;
            margin: 2em 0 !important;
            display: block !important;
        }
        .tinymce-content blockquote {
            border-left: 0.25rem solid #e5e7eb !important;
            padding-left: 1em !important;
            margin: 1.6em 0 !important;
            font-style: italic !important;
            color: #111827 !important;
            display: block !important;
        }
        .tinymce-content code {
            color: #111827 !important;
            font-weight: 600 !important;
            font-size: 0.875em !important;
            background-color: #f3f4f6 !important;
            padding: 0.125rem 0.375rem !important;
            border-radius: 0.25rem !important;
            font-family: monospace !important;
        }
        .tinymce-content pre {
            color: #e5e7eb !important;
            background-color: #1f2937 !important;
            overflow-x: auto !important;
            font-size: 0.875em !important;
            line-height: 1.7142857 !important;
            margin-top: 1.7142857em !important;
            margin-bottom: 1.7142857em !important;
            border-radius: 0.375rem !important;
            padding: 0.8571429em 1.1428571em !important;
            display: block !important;
        }
        .tinymce-content pre code {
            background-color: transparent !important;
            border-width: 0 !important;
            border-radius: 0 !important;
            padding: 0 !important;
            font-weight: 400 !important;
            color: inherit !important;
            font-size: inherit !important;
            font-family: inherit !important;
            line-height: inherit !important;
        }
        .tinymce-content table {
            width: 100% !important;
            table-layout: auto !important;
            text-align: left !important;
            margin-top: 2em !important;
            margin-bottom: 2em !important;
            font-size: 0.875em !important;
            line-height: 1.7142857 !important;
            border-collapse: collapse !important;
            display: table !important;
        }
        .tinymce-content thead {
            border-bottom: 1px solid #d1d5db !important;
            display: table-header-group !important;
        }
        .tinymce-content thead th {
            color: #111827 !important;
            font-weight: 600 !important;
            vertical-align: bottom !important;
            padding-right: 0.5714286em !important;
            padding-bottom: 0.5714286em !important;
            padding-left: 0.5714286em !important;
            display: table-cell !important;
        }
        .tinymce-content tbody {
            display: table-row-group !important;
        }
        .tinymce-content tbody td {
            vertical-align: baseline !important;
            padding-top: 0.5714286em !important;
            padding-right: 0.5714286em !important;
            padding-bottom: 0.5714286em !important;
            padding-left: 0.5714286em !important;
            display: table-cell !important;
        }
        .tinymce-content tbody tr {
            border-bottom: 1px solid #e5e7eb !important;
            display: table-row !important;
        }
        
        /* Ensure divs and other elements display correctly */
        .tinymce-content div {
            display: block !important;
        }
        
        /* Preserve inline styles from TinyMCE */
        .tinymce-content [style] {
            /* Allow inline styles to override */
        }
    </style>
@stop

