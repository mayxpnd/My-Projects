import { useState } from "react";

const steps = ["Company type", "State", "Business details", "Team", "Personal details"];

function MultiStepForm() {
  const [currentStep, setCurrentStep] = useState(0);
  const goNext = () => setCurrentStep((prev) => Math.min(prev + 1, steps.length - 1));
  const goBack = () => setCurrentStep((prev) => Math.max(prev - 1, 0));

  return (
    <div className="max-w-7xl mx-auto p-6">
      <div className="flex bg-white rounded-xl shadow-lg overflow-hidden">
        {/* Sidebar */}
        <aside className="w-1/4 bg-white border-r p-6 space-y-4">
          <h1 className="text-2xl font-bold text-blue-600 mb-6">📦 InsideBox</h1>
          {steps.map((label, index) => (
            <div key={index} className={`flex items-center space-x-2 ${index <= currentStep ? 'text-blue-600 font-semibold' : 'text-gray-700'}`}>
              <span className="w-5 h-5 flex items-center justify-center border rounded-full text-sm">{index + 1}</span>
              <span>{label}</span>
            </div>
          ))}
        </aside>

        {/* Main content */}
        <main className="flex-1 p-10">
          <StepContent step={currentStep} />
          <div className="flex justify-between mt-10">
            {currentStep > 0 ? (
              <button onClick={goBack} className="px-4 py-2 border rounded-lg">Previous step</button>
            ) : <span />}
            {currentStep < steps.length - 1 && (
              <button onClick={goNext} className="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600">
                Next step
              </button>
            )}
          </div>
        </main>
      </div>
    </div>
  );
}

function StepContent({ step }) {
  switch (step) {
    case 0:
      return (
        <>
          <h2 className="text-2xl font-bold mb-1">Select the type of business entity.</h2>
          <p className="text-gray-500 mb-6">Establish your company in just a few simple steps.</p>
          <div className="space-y-4">
            <Card title="Corporation" description="Owned by stakeholders" active />
            <Card title="LLC" description="Owned by individuals" />
          </div>
        </>
      );
    case 1:
      return (
        <>
          <h2 className="text-2xl font-bold mb-1">Choose the state</h2>
          <p className="text-gray-500 mb-6">Choose the state where you plan to register your new business.</p>
          <div className="grid grid-cols-4 gap-4">
            {["Delaware", "Nevada", "Wyoming", "Florida", "New York", "California", "Washington", "Texas"].map((state) => (
              <div key={state} className="border p-4 rounded-lg hover:shadow text-center">{state}</div>
            ))}
          </div>
        </>
      );
    case 2:
      return (
        <>
          <h2 className="text-2xl font-bold mb-1">About your company</h2>
          <p className="text-gray-500 mb-6">Enter detailed information about your company.</p>
          <div className="grid grid-cols-2 gap-4">
            <input type="text" placeholder="Company name" className="border p-2 rounded" />
            <select className="border p-2 rounded">
              <option>Type</option>
              <option>Startup</option>
              <option>Enterprise</option>
            </select>
            <select className="border p-2 rounded">
              <option>Company size</option>
              <option>1-10</option>
              <option>11-50</option>
            </select>
            <input type="text" placeholder="Address" className="border p-2 rounded col-span-2" />
            <select className="border p-2 rounded">
              <option>Country</option>
              <option>USA</option>
              <option>UK</option>
            </select>
            <input type="text" placeholder="City" className="border p-2 rounded" />
          </div>
        </>
      );
    default:
      return <p>Coming soon...</p>;
  }
}

function Card({ title, description, active }) {
  return (
    <div className={`border p-6 rounded-xl flex items-center cursor-pointer hover:shadow ${active ? 'bg-blue-50 border-blue-400' : 'border-gray-300'}`}>
      <div>
        <h2 className={`font-semibold ${active ? 'text-blue-600' : 'text-gray-700'}`}>{title}</h2>
        <p className="text-gray-500 text-sm">{description}</p>
      </div>
    </div>
  );
}

export default MultiStepForm;

