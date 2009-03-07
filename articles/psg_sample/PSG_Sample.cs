using System;

namespace PSG_Sample
{
	class PSG_Sample {
		static void Main(string[] args) {

			PSGCalc psgcalc = new PSGCalc();

			// try a number of ranges (between 1 and 1.5)
			for (double i = 1; i <= 1.5; i += .01) {
				i = Math.Round(i, 7);	// correct possible error
				psgcalc.doCalculate(i);
			}
	
			Console.WriteLine("\nBest fit: " + psgcalc.lowesterror + " (" + psgcalc.lowesterrorrange + ")\n");

			psgcalc.doCalculate(psgcalc.lowesterrorrange);

			// Calculate & output best fit
			const int valsperline = 6;
			for (int i=0; i<psgcalc.mapvalues.Length; i++) {
				if ((i % valsperline) == 0) {
					Console.Write("\n\tDB  ");
				} else {
					Console.Write(", ");
				}
				Console.Write(
					  (psgcalc.mapvalues[i] % 16).ToString("00") + ","
					+ (psgcalc.mapvalues[i] / 16 % 16).ToString("00") + ","
					+ (psgcalc.mapvalues[i] / 256 % 16).ToString("00"));
			}
			Console.WriteLine();

			Console.WriteLine("\nTotal discrete values found: " + psgcalc.totaldiscretevalues + "\n");

			Console.WriteLine("Press any key to continue...");
			Console.Read();
		}


	}

	//
	// This class calculates an array of PSG channel volumes to use for replaying
	// 8-bit samples.
	//
	// Call it as follows:
	//   PSGCalc psgcalc = new PSGCalc();
	//   psgcalc.doCalculate(range)
	//
	// Where range is a number from 0 to 3 which represents the output volume range.
	// 1.328 is the range with the least amount of errors, but any range from 0.5 to 2.0
	// will give good results.
	//
	// The result is in the mapvalues[0..255] array, which contains the combination of
	// the three PSG channel volumes: a + b*16 + c * 256.
	//
	class PSGCalc {
		// arrays containing all possible output values
		public double[] psgmap = new double[16];		// 1 channel
		public double[] psgmap3 = new double[16*16*16];	// 3 channels

		// total discrete values
		public int totaldiscretevalues;
		
		// lowest error discovered so far in a Calculate run...
		public double lowesterror = 999;
		public double lowesterrorrange;

		// map values picked and their discrete values
		const int discrange = 256;	// nr. of discrete values
		public int[] mapvalues = new int[discrange];

		//
		// Constructor
		//
		public PSGCalc() {
			// first value is 0
			psgmap[0] = 0;

			// calculate the other 15 output values
			for (int i=1; i<16; i++) {
				psgmap[i] = Math.Pow(2,-((15-i)/2.0));
			}
		
			// generate combined 3-channel output values
			for (int k=0; k<16; k++) {
				for (int j=0; j<16; j++) {
					for (int i=0; i<16; i++) {
						psgmap3[k*256+j*16+i] = psgmap[i]+psgmap[j]+psgmap[k];
					}
				}
			}

			// count total discrete values (taking double type errors into account)
			totaldiscretevalues = 1;
			double[] bla = new double[psgmap3.Length];
			bla[0] = psgmap3[0];
			for (int i=1; i<psgmap3.Length; i++) {
				bool match = false;
				for (int j=0; j<totaldiscretevalues; j++) {
					if (Math.Abs(psgmap3[i] - bla[j]) < 0.0000001) {
						match = true;
						break;
					}
				}
				if (!match) bla[totaldiscretevalues++] = psgmap3[i];
			}
		}


		//
		// Calculate a mapping of discrete values,
		// and calculate the amount of errors.
		// @param valrange  Range of values to operate on
		//
		public void doCalculate(double valrange) {
			double errors = 0;
			for (int i=0; i<discrange; i++) {
				double curval = ((double)i / (discrange-1)) * valrange;
				mapvalues[i] = 0;
				// find optimal map entry
				for (int j=0; j<psgmap3.Length; j++) {
					if (Math.Abs(psgmap3[j] - curval) <
						Math.Abs(psgmap3[mapvalues[i]] - curval) &&
						Math.Abs(	// ignore double type errors
							Math.Abs(psgmap3[j] - curval) -
							Math.Abs(psgmap3[mapvalues[i]] - curval))
						> 0.0000001)
						mapvalues[i] = j;
					else if (Math.Abs(psgmap3[j] - curval) < 0)
						break;
				}
				// calculate and add error
				errors += Math.Abs(curval - psgmap3[mapvalues[i]]);
			}
			// normalise error
			errors = errors / valrange;

			Console.WriteLine("Total error: " + errors.ToString("0.00000") + " (range: " + valrange + ")");

			// if lower than lowest error so far...
			if (errors < lowesterror) {
				lowesterror = errors;
				lowesterrorrange = valrange;
			}
		}
	}
}
