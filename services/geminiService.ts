
import { GoogleGenAI, Type, Modality } from "@google/genai";

const API_KEY = process.env.GEMINI_API_KEY || "";

export const generateLuxuryImage = async (prompt: string, size: "1K" | "2K" | "4K" = "1K", aspectRatio: "1:1" | "16:9" | "9:16" = "16:9") => {
  const ai = new GoogleGenAI({ apiKey: API_KEY });
  const response = await ai.models.generateContent({
    model: 'gemini-3-pro-image-preview',
    contents: {
      parts: [
        { text: `Create a luxurious designer interior for a Jakarta travel and culinary brand. Atmosphere: elegant, sophisticated, dark themes with gold accents. Topic: ${prompt}` },
      ],
    },
    config: {
      imageConfig: {
        aspectRatio,
        imageSize: size
      },
    },
  });

  for (const part of response.candidates?.[0]?.content?.parts || []) {
    if (part.inlineData) {
      return `data:image/png;base64,${part.inlineData.data}`;
    }
  }
  return null;
};

export const chatWithConcierge = async (message: string) => {
  const ai = new GoogleGenAI({ apiKey: API_KEY });
  const chat = ai.chats.create({
    model: 'gemini-3-pro-preview',
    config: {
      systemInstruction: 'Anda adalah Konserje Mewah Jakarta untuk brand "Jakarta Luxury AI". Anda membantu merencanakan perjalanan eksklusif dan desain kuliner. Gunakan bahasa Indonesia yang sangat sopan dan elegan. Bantu pengguna dengan rekomendasi tempat, reservasi, dan desain.',
      thinkingConfig: { thinkingBudget: 32768 }
    },
  });

  const response = await chat.sendMessage({ message });
  return response.text;
};

export const searchJakartaTrends = async (query: string) => {
  const ai = new GoogleGenAI({ apiKey: API_KEY });
  const response = await ai.models.generateContent({
    model: "gemini-3-flash-preview",
    contents: query,
    config: {
      tools: [{ googleSearch: {} }],
    },
  });

  return {
    text: response.text,
    sources: response.candidates?.[0]?.groundingMetadata?.groundingChunks || []
  };
};

export const generateSpeech = async (text: string) => {
  const ai = new GoogleGenAI({ apiKey: API_KEY });
  const response = await ai.models.generateContent({
    model: "gemini-2.5-flash-preview-tts",
    contents: [{ parts: [{ text }] }],
    config: {
      responseModalities: [Modality.AUDIO],
      speechConfig: {
        voiceConfig: {
          prebuiltVoiceConfig: { voiceName: 'Kore' },
        },
      },
    },
  });
  return response.candidates?.[0]?.content?.parts?.[0]?.inlineData?.data;
};
