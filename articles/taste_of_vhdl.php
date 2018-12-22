<?php include $_SERVER['DOCUMENT_ROOT'].'/scripts/functions.php'; addHTTPHeader(); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
  <title>A taste of VHDL</title>
  <?php addStyles(); ?>
</head>
<body>
<?php addHeader(); ?>



<h1>A taste of VHDL</h1>


<h2>1. History</h2>


<p>For developing extremely complex ICs of hundreds of thousands of gates,
VHDL, a new hardware description language, was proposed in 1981, issuing:</p>

<ul>
	<li>Description of complex ICs</li>
	<li>Standardisation for sourcetext exchangeability</li>
</ul>

<p>Version 7.2 was released for public review in August 1985,
and, after some revisions and changes, VHDL was adopted as
IEEE-standard 1076 in December 1987.
The language was updated in 1992 with some minor improvements.</p>


<h2>2. The meaning of the name</h2>


<p>Like the acronym MRC, where the first letter M itself denotes
an acronym, VHDL stands for <dfn>VHSIC Hardware Description Language</dfn>
with <dfn>VHSIC</dfn> meaning <dfn>Very High Speed Integrated Circuit</dfn>,
a program funded by the american Department of Defense (DoD)
in the late 1970s and early 1980s.
So VHDL isn't a programming-, but a <dfn>hardware description language</dfn>!
Therefore, sourcetexts written in VHDL are refered to
as <dfn>design descriptions</dfn> or <dfn>models</dfn>.</p>


<h2>3. Designing in VHDL</h2>


<p>VHDL is used to design and document electronic systems.
It provides the textual and formal and thus <dfn>executable</dfn> description
of a design.
You can either design top-down or bottom-up by creating a behavioral and/or
structural model and validating it with a simulator.</p>

<p>In VHDL, design activities are organized in <dfn>projects</dfn>.
Therefore, to start working, you first must create a project.
After having opened it, you'll find the <dfn>work library</dfn>,
where the compiled components will be stored.
New VHDL designs must be added explicitly to a project.</p>

<p>Compiling a VHDL design yields a <dfn>netlist</dfn>, which can be
<dfn>simulated</dfn> and <dfn>synthesized</dfn>.</p>

<p>To avoid spending money for nothing, i.e. producing ICs with design errors,
circuit behaviour must be simulated before the chip is manufactured.
The later such errors are detected, the more expensive is it to remove them.
At the end of this process there'll be a <dfn>mask layout</dfn> for
ASIC production or a <dfn>bitstream file</dfn> to be loaded into an FPGA device.
Since the 1-Chip-MSX will be implemented in such a device,
we need not bother about mask layout and the things related.</p>

<p>VHDL offers three ways of describing hardware, which can be intermixed
freely:</p>

<ul>
	<li>Dataflow description</li>
	<li>Algorithmic description</li>
	<li>Structural description</li>
</ul>

<p><dfn>Dataflow description</dfn> is using boolean equations,
while an <dfn>algorithmic description</dfn> looks similar to the source code
of programming languages like Pascal or Ada.
Algorithmic and dataflow descriptions are behavioural descriptions
on different abstraction levels, in <dfn>structural descriptions</dfn>,
components are instantiated and wired up by signals.</p>


<h2>4. Names in VHDL</h2>


<p>A name (identifier) in VHDL must begin with a letter, followed by
letters, digits, and maybe with underscores within.
VHDL is <em>not case sensitive</em>, so <var>x</var> is not distinguished
from <var>X</var>.
Within the same <dfn>scope</dfn>, two different objects cannot have
the same name.</p>


<h2>5. Types in VHDL</h2>


<p>VHDL is a <dfn>strongly typed language</dfn> allowing some kind of errors
to be detected as early as possible in the development cycle.
The first value in the type's enumeration of constants is used
as the simulator's default initial value for signals of that type.</p>


<h2>6. Interfaces and architectures</h2>


<p>To understand the important concept of separating interfaces from
architectures, let us first consider schematics:</p>

<p>In a schematic, there are components connected by wires.
The component is a named black box telling about its functionality,
but hiding implementation details of its design.
Each component has named wires going in and out the box,
letting you just know about its <dfn>interface</dfn>.</p>

<p>Similarly, one major concept of VHDL is the separation of
interface description from the description of how the design is
implemented, called its <dfn>architecture</dfn>.</p>

<p>In VHDL, the resered word <code>entity</code> introduces a name for
the interface of a component.
The keyword <code>architecture</code> introduces the description of
an implementation of a certain component.</p>

<p>Actually, for a certain entity, more than one architecture may exist, each
of them intended for realizing the same functionallity in a different way:
So, one may require a high amount of chip space, but would work very fast,
while another one would need less space but would be slower.</p>


<h2>7. Description of a NAND gate in VHDL</h2>


<p>In VHDL, comments start with the <code>--</code> symbol and are at most one line.
The <code>&lt;=</code> symbol denotes signal assignement.</p>


<pre>
Library IEEE;
use IEEE.std_logic_1164.all;
        

ENTITY nand_gate IS
  port
  (
   a,b : in  std_logic;
   c   : out std_logic
  );
END nand_gate;

       
ARCHITECTURE dataflow OF nand_gate IS

BEGIN -- dataflow
  c &lt;= not ( a and b ) ;
END dataflow;


ARCHITECTURE dataflow_delay OF nand_gate IS

BEGIN -- dataflow_delay
  c &lt;= not ( a and b ) after 10 ns ;
END dataflow_delay;


ARCHITECTURE algorithmic OF nand_gate IS

BEGIN -- algorithmic

  PROCESS (a,b)

  BEGIN -- PROCESS
    IF ( ( a='1' ) and ( b='1' ) ) THEN c&lt;='0'; ELSE c&lt;='1'; END IF;
  END PROCESS;

END algorithmic;
</pre>


<h3>7.1. Library</h3>


<p>To open a library to access a compiled entity (component),
a library declaration must precede the entity declaration.
For the built-in libraries <code>WORK</code> and <code>STD</code>,
no library statement is required.
<code>std.standard.all</code> is set by default.</p>

<p>The <code>use</code> statement makes library elements directly available to the
design unit, without having to use selected names, that means compound names
separated by a dot. Its scope is limited to the design unit it precedes.</p>

<p>Type <code>std_logic</code> declared in the <dfn>IEEE library</dfn> is made available
through the library declaration and the <code>use</code> statement preceding
the declaration of the entity <code>nand_gate</code>.</p>


<h3>7.2. Entity</h3>


<p>In the <dfn>port list</dfn> of entity <code>nand_gate</code>, every port is
of type <code>std_logic</code>.</p>

<p>Note that, between colon and type designator, there are either
<code>in</code> or <code>out</code> to specify the direction of the signals.</p>


<h3>7.3. Architecture</h3>


<p>In VHDL, an architecture specifies the entity it belongs to.</p>

<p>Architecture <code>dataflow</code> just contains a boolean expression
assigned to the outgoing port.</p>

<p>Additionally, in architecture <code>dataflow_delay</code>,
there's a delay time of 10 nanoseconds specified in order to model
the gate's propagation delay.
For simulation, you can see the impact of changing the delay time
for some gates or components to the operation of the whole design.
For synthesis, since we use an FPGA, the propagation delay of
the CLB emulating the gate is constant and need not to be modeled.</p>

<p>In architecture <code>algorithmic</code> of entity <code>nand_gate</code>,
the process-statement indicates an algorithmic description.
The parenthesised list following the keyword <code>process</code> is called
<dfn>sensitivity list</dfn>.
During simulation, the process will only be executed if there's a change
in at least one of the signals of that list.</p>


<h2>8. Simulation</h2>


<p>The compiled components in the WORK library can be seen as templates for
possibly many instances of them in the architectures of other entities.
To check if the nand gate works right, it must be instantiated in a special
architecture to simulate it.
The declarations made there provide our gate with the required signals
and stimuli values.</p>


<pre>
Library IEEE;
use IEEE.std_logic_1164.all;

        
ENTITY SimBox IS

END SimBox;

        
ARCHITECTURE test_nand OF SimBox IS


COMPONENT nand_gate
  port
  (
   a,b : in  std_logic;
   c   : out std_logic
  );
END COMPONENT;
        

SIGNAL a_test, b_test, c_test : std_logic;


BEGIN -- test_nand
  my_nand_gate : nand_gate
  port map 
  (
   a => a_test,
   b => b_test,
   c => c_test
  );
  a_test
  &lt;=
  '0' after 0 ns,
  '1' after 2 ns,
  '0' after 4 ns,
  '1' after 6 ns
  ;
  b_test
  &lt;=
  '0' after 0 ns,
  '0' after 2 ns,
  '1' after 4 ns,
  '1' after 6 ns
  ;
END test_nand;
</pre>


<p>The entity <code>SimBox</code> doesn't need any input or output lines,
so the port statement is omitted.
It's architecture contains the component declaration of the nand gate.
Then, three signals are declared to be from type <code>std_logic</code>
to wire up the gate.</p>

<p>In the statement block of the architecture <code>test_nand</code>,
<code>my_test_nand</code> is <dfn>instantiated</dfn> to be a <code>nand_gate</code>
and connected to the previously declared signals via its port map.</p>

<p>The next two statements are to supply the signals <code>a_test</code>
and <code>b_test</code> with stimuli.</p>


<h2>9. Configuration</h2>


<p>As a consequence of the linguistic separation of interface and architecture,
VHDL needs a mechanism to tell the compiler which architecture to take for
creating the netlist.
This is accomplished by configuration statements.</p>


<pre>
CONFIGURATION nand_test_dataflow OF SimBox IS
  FOR test_nand
    FOR my_nand_gate : nand_gate
      use entity work.nand_gate(dataflow);
    END FOR; -- my_nand_gate
  END FOR; -- test_nand
END nand_test_dataflow;


CONFIGURATION nand_test_dataflow_delay OF SimBox IS
  FOR test_nand
    FOR my_nand_gate : nand_gate
      use entity work.nand_gate(dataflow_delay);
    END FOR; -- my_nand_gate
  END FOR; -- test_nand
END nand_test_dataflow_delay;


CONFIGURATION nand_test_algorithmic OF SimBox IS
  FOR test_nand
    FOR my_nand_gate : nand_gate
      use entity work.nand_gate(algorithmic);
    END FOR; -- my_nand_gate
  END FOR; -- test_nand
END nand_test_algorithmic;
</pre>


<p>This mechanism is very useful if you need to simulate a design consisting of
many components, where each of them can be realized in many ways.</p>

<p>Imagine, you have to design a device build up of two different components,
where one can be implemented in 3 and the other in 7 different ways.
So, there are 21 different combinations realizing the required functionality.
Maybe only 9 of them are interesting to you, because you already know
that the others will be too expensive or too slow.</p>




<p class="signed">Wolfgang Fischer (Tanni)</p>

<p>
	<img src="taste_of_vhdl/mrc-nand.source.png" alt="A programming IDE with VHDL code" title="Screenshot of the code in a Xilinx environment." />
</p>




<?php addFooter(); ?>
</body>
</html>