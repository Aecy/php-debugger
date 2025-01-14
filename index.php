<?php

function highlight($data, $tab = 1)
{
    $indent = str_repeat(' ', $tab);
    $closingIndent = str_repeat(' ', max(0, $tab - 1));

    if (is_array($data)) {
        $output = [];
        foreach ($data as $key => $value) {
            $keyFormatted = "\"<span class='sf-dump-str'>$key</span>\"";
            $valueFormatted = highlight($value, $tab + 2);
            $output[] = "$indent$keyFormatted =&gt; $valueFormatted";
        }
        $content = implode(",\n", $output);
        $count = count($output);

        return "<span class='sf-dump-note'>array:$count</span> [\n$content\n$closingIndent]";
    } elseif (is_object($data)) {
        $output = [];
        foreach (get_object_vars($data) as $key => $value) {
            $keyFormatted = "\"<span class='sf-dump-str'>$key</span>\"";
            $valueFormatted = highlight($value, $tab + 2);
            $output[] = "$indent$keyFormatted =&gt; $valueFormatted";
        }
        $content = implode(",\n", $output);
        $className = get_class($data);

        return "<span class='sf-dump-note'>$className</span> {\n$content\n$closingIndent}";
    } elseif (is_string($data)) {
        return "\"<span class='sf-dump-str'>$data</span>\"";
    } elseif (is_int($data) || is_float($data)) {
        return "<span class='sf-dump-num'>$data</span>";
    } elseif (is_bool($data)) {
        return "<span class='sf-dump-const'>" . ($data ? 'true' : 'false') . "</span>";
    } elseif (is_null($data)) {
        return "<span class='sf-dump-const'>null</span>";
    }

    return $data;
}

function dump($data)
{
    echo "<style>
        .sf-dump {
            background: #18171B;
            color: #FF8400;
            font: 12px 'JetBrains Mono', Menlo, Monaco, Consolas, monospace;
            word-wrap: break-word;
            white-space: pre-wrap;
            position: relative;
            z-index: 99999;
            word-break: break-word;
            padding: .4rem;
            margin-bottom: 0.1rem;
            overflow: auto;
            max-height: 400px;
        }

        pre.sf-dump .sf-dump-key {
            color: #FF8400;
            font-weight: bold;
        }

        pre.sf-dump .sf-dump-str {
            color: #56DB3A;
        }

        pre.sf-dump .sf-dump-num {
            color: #1299DA;
        }

        pre.sf-dump .sf-dump-const {
            font-weight: bold;
        }
        
        pre.sf-dump .sf-dump-note {
            color: #1299DA;
        }
        
        pre.sf-dump .sf-dump-public {
            color: #FFFFFF;
        }
    </style>";

    echo "<pre class='sf-dump'>";
    echo highlight($data);
    echo "</pre>";
}

function dd($data)
{
    dump($data);

    die();
}
