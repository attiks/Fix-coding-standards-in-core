<?php

$sniffs = array(
  // 'Drupal.Array.Array' => 2572613, // @see https://www.drupal.org/node/2572587
  // 'Drupal.CSS.ClassDefinitionNameSpacing' => 0, // Skipping css
  // 'Drupal.CSS.ColourDefinition' => 0, // Skipping css
  // 'Drupal.Classes.ClassCreateInstance' => 2572601,
  // 'Drupal.Classes.ClassDeclaration' => 2572619,
  // 'Drupal.Classes.InterfaceName' => 2572631,
  // 'Drupal.Commenting.ClassComment' => 2572633,
  // 'Drupal.Commenting.DocComment' => 2572635,
  // 'Drupal.Commenting.DocCommentStar' => 2572641,
  // 'Drupal.Commenting.FileComment' => 2572643,
  // 'Drupal.Commenting.FunctionComment' => 2572645,
  // 'Drupal.Commenting.HookComment' => 2572649, // No fixable errors were found
  // 'Drupal.Commenting.InlineComment' => 2572659,
  // 'Drupal.ControlStructures.ControlSignature' => 2572693,
  // 'Drupal.ControlStructures.ElseIf' => 2572695,
  // 'Drupal.ControlStructures.InlineControlStructure' => 2572699,
  // 'Drupal.ControlStructures.TemplateControlStructure' => 2572701,
  // 'Drupal.Files.EndFileNewline' => 2572707,
  // 'Drupal.Files.LineLength' => 2572709,
  // 'Drupal.Files.TxtFileLineLength' => 0,
  // 'Drupal.Formatting.MultiLineAssignment' => 0, // No fixable errors were found
  // 'Drupal.Formatting.SpaceInlineIf' => 0, // No fixable errors were found
  // 'Drupal.Formatting.SpaceUnaryOperator' => 2572731,
  // 'Drupal.Functions.DiscouragedFunctions' => 0, // No fixable errors were found
  // 'Drupal.Functions.FunctionDeclaration' => 0, // No fixable errors were found
  // 'Drupal.InfoFiles.ClassFiles' => 0, // No fixable errors were found
  // 'Drupal.InfoFiles.Required' => 0, // No fixable errors were found
  // 'Drupal.NamingConventions.KeywordLowerCase' => 0, // No fixable errors were found
  // 'Drupal.NamingConventions.ValidClassName' => 0, // No fixable errors were found
  // 'Drupal.NamingConventions.ValidFunctionName' => 0, // No fixable errors were found
  // 'Drupal.NamingConventions.ValidGlobal' => 0, // No fixable errors were found
  // 'Drupal.NamingConventions.ValidVariableName' => 0, // No fixable errors were found
  // 'Drupal.Semantics.ConstantName' => 0, // No fixable errors were found
  // 'Drupal.Semantics.EmptyInstall' => 0, // No fixable errors were found
  // 'Drupal.Semantics.FunctionAlias' => 0, // No fixable errors were found
  
  'Drupal.Semantics.FunctionT' => 0,
  'Drupal.Semantics.FunctionWatchdog' => 0,
  'Drupal.Semantics.InstallHooks' => 0,
  'Drupal.Semantics.InstallT' => 0,
  'Drupal.Semantics.LStringTranslatable' => 0,
  'Drupal.Semantics.PregSecurity' => 0,
  'Drupal.Semantics.RemoteAddress' => 0,
  'Drupal.Semantics.TInHookMenu' => 0,
  'Drupal.Semantics.TInHookSchema' => 0,
  //'Drupal.Strings.ConcatenationSpacing' => 0,
  //'Drupal.Strings.UnnecessaryStringConcat' => 0,
  //'Drupal.WhiteSpace.CloseBracketSpacing' => 0,
  //'Drupal.WhiteSpace.Comma' => 0,
  //'Drupal.WhiteSpace.EmptyLines' => 0,
  //'Drupal.WhiteSpace.ObjectOperatorIndent' => 0,
  //'Drupal.WhiteSpace.ObjectOperatorSpacing' => 0,
  //'Drupal.WhiteSpace.OpenBracketSpacing' => 0,
  //'Drupal.WhiteSpace.OperatorSpacing' => 0,
  //'Drupal.WhiteSpace.ScopeClosingBrace' => 0,
  //'Drupal.WhiteSpace.ScopeIndent' => 0,
  //'Generic.PHP.UpperCaseConstant' => 2572307,
);

// Start clean.
passthru('git reset --hard HEAD');
passthru('git checkout 8.0.x');

foreach ($sniffs as $sniff => $nid) {
  passthru('git reset --hard HEAD');
  passthru('git pull');
  passthru('git checkout -b ' . $sniff);
  passthru('git checkout ' . $sniff);
  passthru('git rebase 8.0.x');
  passthru('git reset --hard HEAD');
  passthru('~/.composer/vendor/bin/phpcbf --standard=/home/peter/.composer/vendor/drupal/coder/coder_sniffer/Drupal --sniffs=' . $sniff . ' --ignore=vendor,assets/vendor -p core/');
  passthru('git commit -am \'' . $sniff . '\'');
  passthru('git diff 8.0.x > /tmp/' . ($nid == 0 ? $sniff : $nid) . '.patch');
  passthru('git checkout 8.0.x');
}
