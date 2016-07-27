<?php

$id = $_REQUEST["paste"];

$url = "pastes/".$id.".csharp"; //TODO: File ending should be "*.cs" (optional)

//$content = file_get_contents($url);

$content = "using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.IO;
using System.Net;
using System.Threading;
using Newtonsoft.Json;
using JodelAPI;

namespace JodelBooster
{
    class Program
    {
        static List<string> _tokens = new List<string>();
        static void Main(string[] args)
        {
            int karma = 0;
            Out(\"How many tokens should I generate?: \");
            int amountTokens = Convert.ToInt32(Console.ReadLine());
            for (int i = 0; i < amountTokens; i++)
            {
                try
                {
                    _tokens.Add(API.GenerateAccessToken());
                    Out(\".\");
                }
                catch
                {
                    Outln(\"Blocked\");
                    break;
                }
            }

            Outln(\"\");

            Outln(\"Generated tokens:\");

            foreach (var item in _tokens)
            {
                Outln(item);
            }

            Outln(\"Saving to file...\");
            bool oldFileExisted = false;
            if (File.Exists(\"tokens.txt\"))
            {
                oldFileExisted = true;
                File.AppendAllLines(\"tokens.txt\", _tokens);
            }
            else
            {
                File.WriteAllLines(\"tokens.txt\", _tokens);
            }
            Outln(\"Done.\");

            if (oldFileExisted)
            {
                Outln(\"Old tokens found! Loading...\");
                _tokens.AddRange(File.ReadAllLines(\"tokens.txt\"));
                Outln(\"Removing duplicates...\");
                _tokens = _tokens.Distinct().ToList();
                Outln(\"Overwriting token file...\");
                File.WriteAllLines(\"tokens.txt\", _tokens);
                Outln(\"Everything done!\");
            }

            Outln(\"Loaded \" + _tokens.Count + \" tokens!\");

            Out(\"Up (y) or downvote (n)? \");
            string answer2 = Console.ReadLine();

            Out(\"Should I spam posts (y) or should I just read the postIDs from a file (n)? \");
            string answer = Console.ReadLine();
            if (answer == \"y\")
            {
                Out(\"I will boost your karma now :D But first enter your original accestoken: \");
                API.accessToken = Console.ReadLine();
                API.latitude = \"46.58\";
                API.longitude = \"88.08\";
                API.city = \"Miami\";
                API.countryCode = \"US\";
                Out(\"How many posts should i make?: \");
                int loops = Convert.ToInt32(Console.ReadLine());

                for (int i = 0; i < loops; i++)
                {
                    try
                    {
                        API.PostJodel(\"Hey guys!\");
                        Outln(\"Posted!\");
                    }
                    catch
                    {
                        Outln(\"Error!\");
                    }
                    Thread.Sleep(4000);
                }

                Outln(\"Done!\");

                var jodels = API.GetAllJodels();

                Parallel.ForEach(_tokens, token =>
                {
                    try
                    {
                        API.accessToken = token;
                        Parallel.ForEach(jodels, jodel =>
                        {
                            try
                            {
                                if (answer2 == \"y\")
                                {
                                    API.Upvote(jodel.Item1);
                                }
                                else
                                {
                                    API.Downvote(jodel.Item1);
                                }
                                Outln(\"Added 10 Karma!\");
                            }
                            catch
                            {
                                Outln(\"WTF! The cookie was fake!\");
                            }
                        });
                    }
                    catch
                    {
                        Outln(\"WTF! The cookie was fake!\");
                    }
                });
            }
            else if (answer == \"n\")
            {
                Out(\"from original AT list (y) or only from postids list (n)?\");
                string answer1 = Console.ReadLine();
                if (answer1 == \"y\")
                {
                    Outln(\"Reading original AT list\");
                    if (File.Exists(\"at.txt\"))
                    {
                        List<string> ats = File.ReadAllLines(\"at.txt\").ToList();
                        List<string> postIDs = new List<string>();
                        foreach (var at in ats)
                        {
                            Outln(\"Fetching PostIDs from \" + at);
                            string plainJson = GetPageContent(\"https://api.go-tellm.com/api/v2/posts/mine/combo?access_token=24ec937d-8a57-435e-8a83-f9bfcfdca058\" + at);
                            Me.RootObject me = JsonConvert.DeserializeObject<Me.RootObject>(plainJson);
                            foreach (var item in me.recent)
                            {
                                postIDs.Add(item.post_id);
                                Outln(item.post_id + \" added.\");
                            }
                        }
                        Outln(\"Fetched all postIDs... Let's dance\");
                        Parallel.ForEach(_tokens, token =>
                        {
                            try
                            {
                                API.accessToken = token;
                                Parallel.ForEach(postIDs, id =>
                                {
                                    try
                                    {
                                        if (answer2 == \"y\")
                                        {
                                            API.Upvote(id);
                                        }
                                        else
                                        {
                                            API.Downvote(id);
                                        }
                                        karma += 10;
                                        Outln(\"Karma: \" + karma.ToString());
                                    }
                                    catch
                                    {
                                        Outln(\"WTF! The cookie was fake!\");
                                    }
                                });
                            }
                            catch
                            {
                                Outln(\"WTF! The cookie was fake!\");
                            }
                        });

                    }
                }
                else if (answer1 == \"n\")
                {
                    Outln(\"Reading postid list\");
                    if (File.Exists(\"postids.txt\"))
                    {
                        List<string> postIDs = File.ReadAllLines(\"postids.txt\").ToList();
                        Parallel.ForEach(_tokens, token =>
                        {
                            int counter = 0;
                            try
                            {
                                API.accessToken = token;
                                Parallel.ForEach(postIDs, id =>
                                {
                                    try
                                    {
                                        if (counter >= 150)
                                        {

                                        }
                                        else
                                        {
                                            if (answer2 == \"y\")
                                            {
                                                API.Upvote(id);
                                            }
                                            else
                                            {
                                                API.Downvote(id);
                                            }
                                            counter++;
                                            Outln(\"Added 10 Karma!\");
                                        }
                                    }
                                    catch
                                    {
                                        Outln(\"WTF! The cookie was fake!\");
                                    }
                                });
                            }
                            catch
                            {
                                Outln(\"WTF! The cookie was fake!\");
                            }
                        });

                    }
                }
                else
                {
                    Outln(\"file does not exist!\");
                    Thread.Sleep(2000);
                    return;
                }
            }
            else
            {
                Outln(\"y or n only\");
                Thread.Sleep(2000);
                return;
            }


            Outln(\"Done!\");

            Console.Read();
        }

        static void Out(string text)
        {
            Console.Write(text);
        }

        static void Outln(string text)
        {
            Console.WriteLine(text);
        }

        static string GetPageContent(string link)
        {
            string html = string.Empty;
            WebRequest request = WebRequest.Create(link);
            WebResponse response = request.GetResponse();
            Stream data = response.GetResponseStream();
            using (StreamReader sr = new StreamReader(data))
            {
                html = sr.ReadToEnd();
            }
            return html;
        }

    }
}
";

$colored_words_array = [
    'blue' => [
        "abstract",
        "as",
        "base",
        "bool",
        "break",
        "byte",
        "case",
        "catch",
        "char",
        "checked",
        "class",
        "const",
        "continue",
        "decimal",
        "default",
        "delegate",
        "do",
        "double",
        "else",
        "enum",
        "event",
        "explicit",
        "extern",
        "false",
        "finally",
        "fixed",
        "float",
        "for",
        "foreach",
        "goto",
        "if",
        "implicit",
        "in",
        "int",
        "interface",
        "internal",
        "is",
        "lock",
        "long",
        "namespace",
        "new",
        "null",
        "object",
        "operator",
        "out",
        "override",
        "params",
        "private",
        "protected",
        "public",
        "readonly",
        "ref",
        "return",
        "sbyte",
        "sealed",
        "short",
        "sizeof",
        "stackalloc",
        "static",
        "string",
        "struct",
        "switch",
        "this",
        "throw",
        "true",
        "try",
        "typeof",
        "uint",
        "ulong",
        "unchecked",
        "unsafe",
        "ushort",
        "using",
        "virtual",
        "volatile",
        "void",
        "while"
    ],
    'yellow' => [

    ]
];

$colored_content = $content;

foreach ($colored_words_array as $color_name => $word_array) {
    foreach ($word_array as $word) {
        $colored_span = '<span style="color:'.$color_name.'">'.$word.'</span>'; //TODO: replace $color_name by $hex_color!
        $colored_content = preg_replace('/\b'.$word.'\b/', $colored_span, $content);
        $content = $colored_content;
    }
}

echo '<pre>'.$colored_content.'</pre>';